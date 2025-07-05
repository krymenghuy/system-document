<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $category = $request->get('category', '');
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        $documents = collect();
        $categories = DocumentCategory::all();

        if ($query) {
            $documentQuery = Document::with(['category'])
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%")
                      ->orWhere('author', 'like', "%{$query}%");
                });

            // Filter by category
            if ($category) {
                $documentQuery->where('category_id', $category);
            }

            // Sort results
            $documentQuery->orderBy($sortBy, $sortOrder);

            $documents = $documentQuery->paginate(12);
        }

        return view('frontends.search.index', compact('documents', 'categories', 'query'));
    }
}
