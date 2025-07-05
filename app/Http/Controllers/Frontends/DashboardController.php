<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // User's documents (if user_id exists in documents table)
        $myDocuments = collect(); // Empty collection for now since documents don't have user_id

        // User's evaluations
        $myEvaluations = DocumentEvaluation::with(['document.category'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Statistics
        $totalDocuments = Document::count();
        $totalEvaluations = DocumentEvaluation::where('user_id', $user->id)->count();
        $averageRating = DocumentEvaluation::where('user_id', $user->id)->avg('rating');

        // Recent activity
        $recentActivity = collect();

        // Add recent evaluations
        foreach ($myEvaluations as $evaluation) {
            $recentActivity->push([
                'type' => 'evaluation',
                'title' => 'Rated "' . $evaluation->document->name . '"',
                'date' => $evaluation->created_at,
                'icon' => 'fas fa-star',
                'color' => 'warning'
            ]);
        }

        // Sort by date
        $recentActivity = $recentActivity->sortByDesc('date')->take(10);

        return view('frontends.dashboard.index', compact(
            'user',
            'myDocuments',
            'myEvaluations',
            'totalDocuments',
            'totalEvaluations',
            'averageRating',
            'recentActivity'
        ));
    }
}
