<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use App\Models\Document;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DocumentCategory::withCount(['documents'])
            ->orderBy('name')
            ->get();

        return view('frontends.categories.index', compact('categories'));
    }

    public function show(DocumentCategory $category)
    {
        $documents = Document::where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontends.categories.show', compact('category', 'documents'));
    }
}
