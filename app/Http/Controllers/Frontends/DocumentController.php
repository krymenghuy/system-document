<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with(['category']);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Sort by
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $documents = $query->paginate(12);
        $categories = DocumentCategory::all();

        return view('frontends.documents.index', compact('documents', 'categories'));
    }

    public function show(Document $document)
    {
        // Get related documents
        $relatedDocuments = Document::where('category_id', $document->category_id)
            ->where('id', '!=', $document->id)
            ->limit(6)
            ->get();

        // Get user evaluation if authenticated
        $userEvaluation = null;
        if (Auth::check()) {
            $userEvaluation = DocumentEvaluation::where('document_id', $document->id)
                ->where('user_id', Auth::id())
                ->first();
        }

        // Get average rating
        $averageRating = DocumentEvaluation::where('document_id', $document->id)
            ->avg('rating');

        return view('frontends.documents.show', compact('document', 'relatedDocuments', 'userEvaluation', 'averageRating'));
    }

    public function download(Document $document)
    {
        // Check if file exists
        if (!Storage::exists($document->file_path)) {
            abort(404, 'File not found');
        }

        return Storage::download($document->file_path, $document->name . '.pdf');
    }

    public function myDocuments()
    {
        $documents = Document::where('user_id', Auth::id())
            ->with(['category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontends.documents.my-documents', compact('documents'));
    }

    public function evaluate(Request $request, Document $document)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500'
        ]);

        // Check if user already evaluated
        $existingEvaluation = DocumentEvaluation::where('document_id', $document->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingEvaluation) {
            // Update existing evaluation
            $existingEvaluation->update([
                'text' => $request->comment,
                'rating' => $request->rating
            ]);
        } else {
            // Create new evaluation
            DocumentEvaluation::create([
                'document_id' => $document->id,
                'user_id' => Auth::id(),
                'text' => $request->comment,
                'rating' => $request->rating
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your evaluation!');
    }
}
