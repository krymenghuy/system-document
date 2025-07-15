<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DocumentEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get user statistics
        $totalEvaluations = DocumentEvaluation::where('user_id', $user->id)->count();
        $averageRating = DocumentEvaluation::where('user_id', $user->id)->avg('rating');
        $recentEvaluations = DocumentEvaluation::with(['document.category'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get activity timeline
        $activities = collect();
        foreach ($recentEvaluations as $evaluation) {
            $activities->push([
                'type' => 'evaluation',
                'title' => 'Rated "' . $evaluation->document->name . '"',
                'date' => $evaluation->created_at,
                'icon' => 'fas fa-star',
                'color' => 'warning',
                'rating' => $evaluation->rating
            ]);
        }

        $activities = $activities->sortByDesc('date')->take(10);

        return view('frontends.profile.index', compact(
            'user',
            'totalEvaluations',
            'averageRating',
            'recentEvaluations',
            'activities'
        ));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('frontends.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'timezone' => ['nullable', 'string', 'max:50'],
            'language' => ['nullable', 'string', 'max:10'],
            'notifications_email' => ['boolean'],
            'notifications_push' => ['boolean'],
            'privacy_profile' => ['boolean'],
            'privacy_activity' => ['boolean']
        ]);

        $data = $request->only([
            'name', 'email', 'phone', 'bio', 'location', 'website',
            'timezone', 'language', 'notifications_email', 'notifications_push',
            'privacy_profile', 'privacy_activity'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            $photoPath = $request->file('photo')->store('users/photos', 'public');
            $data['photo'] = $photoPath;
        }

        $user->update($data);

        return redirect()->route('frontend.profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required', 'string']
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('frontend.profile')
            ->with('success', 'Password changed successfully!');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
            'confirmation' => ['required', 'string', 'in:DELETE']
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password is incorrect.']);
        }

        // Delete user photo if exists
        if ($user->photo && Storage::exists('public/' . $user->photo)) {
            Storage::delete('public/' . $user->photo);
        }

        // Delete user evaluations
        DocumentEvaluation::where('user_id', $user->id)->delete();

        // Delete user account
        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.name')
            ->with('success', 'Your account has been deleted successfully.');
    }

    public function exportData()
    {
        $user = Auth::user();

        // Get user data
        $userData = [
            'profile' => $user->only(['name', 'email', 'phone', 'bio', 'location', 'website', 'created_at']),
            'evaluations' => DocumentEvaluation::where('user_id', $user->id)
                ->with(['document.category'])
                ->get()
                ->map(function($evaluation) {
                    return [
                        'document_name' => $evaluation->document->name,
                        'category' => $evaluation->document->category->name,
                        'rating' => $evaluation->rating,
                        'comment' => $evaluation->text,
                        'created_at' => $evaluation->created_at->format('Y-m-d H:i:s')
                    ];
                })
        ];

        $filename = 'user_data_' . $user->id . '_' . date('Y-m-d_H-i-s') . '.json';

        return response()->json($userData)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function activity()
    {
        $user = Auth::user();

        $activities = collect();

        // Get evaluations
        $evaluations = DocumentEvaluation::with(['document.category'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($evaluations as $evaluation) {
            $activities->push([
                'type' => 'evaluation',
                'title' => 'Rated "' . $evaluation->document->name . '"',
                'description' => $evaluation->text ?: 'No comment provided',
                'date' => $evaluation->created_at,
                'icon' => 'fas fa-star',
                'color' => 'warning',
                'rating' => $evaluation->rating,
                'document' => $evaluation->document
            ]);
        }

        $activities = $activities->sortByDesc('date')->paginate(20);

        return view('frontends.profile.activity', compact('activities'));
    }

    public function settings()
    {
        $user = Auth::user();

        $settings = [
            'notifications' => [
                'email' => $user->notifications_email ?? true,
                'push' => $user->notifications_push ?? true,
                'marketing' => $user->notifications_marketing ?? false
            ],
            'privacy' => [
                'profile' => $user->privacy_profile ?? true,
                'activity' => $user->privacy_activity ?? true,
                'search' => $user->privacy_search ?? true
            ],
            'preferences' => [
                'timezone' => $user->timezone ?? 'UTC',
                'language' => $user->language ?? 'en',
                'theme' => $user->theme ?? 'light'
            ]
        ];

        return view('frontends.profile.settings', compact('user', 'settings'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'notifications_email' => ['boolean'],
            'notifications_push' => ['boolean'],
            'notifications_marketing' => ['boolean'],
            'privacy_profile' => ['boolean'],
            'privacy_activity' => ['boolean'],
            'privacy_search' => ['boolean'],
            'timezone' => ['string', 'max:50'],
            'language' => ['string', 'max:10'],
            'theme' => ['string', 'in:light,dark,auto']
        ]);

        $user->update($request->all());

        return redirect()->route('frontend.profile.settings')
            ->with('success', 'Settings updated successfully!');
    }
}
