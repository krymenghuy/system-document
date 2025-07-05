<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        // $data['documents'] = Document::with('category')->paginate(2);
        $data['documents'] = DB::table('documents')->paginate(2);
        $search = $request->input('search'); // Retrieve the search input

        // Query to fetch documents with related category and apply search conditions
        $documents = Document::with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('author', 'LIKE', "%$search%")
                    ->orWhere('publication_year', 'LIKE', "%$search%")
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'LIKE', "%$search%");
                    });
            })
            ->paginate(2);

        // Pass data and search term to the view
        return view('backends.documents.index', [
            'documents' => $documents,
            'search' => $search,
        ]);
    }

    public function create()
    // $data['documents'] = Document::with('category')->paginate(10);
    {
        $categories = DocumentCategory::all();
        return view('backends.documents.create', compact('categories'));
    }

    // public function store(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'publication_year' => 'required|integer',
    //         'file' => 'required|file',
    //         'description' => 'nullable|string',
    //         'category_id' => 'required|exists:document_categories,id',
    //     ]);
    //  if ($request->hasFile('file') && $request->file('file')->isValid()) {
    //         // Store the file in the 'documents' directory within the 'public' disk
    //         $filePath = $request->file('file')->store('documents', 'public');

    //     Document::create([
    //         'name' => $request->name,
    //         'author' => $request->author,
    //         'publication_year' => $request->publication_year,
    //         'file_path' => $filePath,
    //         'description' => $request->description,
    //         'category_id' => $request->category_id,
    //     ]);

    //     return redirect()->route('admin.documents')->with('success', 'Document created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'file' => 'required|file',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:document_categories,id',
        ]);

        // Store the uploaded file
        $filePath = $request->file('file')->store('documents', 'public');

        // Save the record in the database
        Document::create([
            'name' => $validatedData['name'],
            'author' => $validatedData['author'],
            'publication_year' => $validatedData['publication_year'],
            'file_path' => $filePath, // Store the file path
            'description' => $validatedData['description'] ?? null,
            'category_id' => $validatedData['category_id'],
        ]);

        // Redirect or return a response
        return redirect()->route('admin.documents')->with('success', 'Document created successfully.');
    }


    public function show($document_id)
    {
        $document = Document::findOrFail($document_id);
        $document->load('category', 'evaluations');
        return view('backends.documents.show', compact('document'));
    }

    public function edit($document_id)
    {
        $document = Document::findOrFail($document_id);
        $categories = DocumentCategory::all();
        return view('backends.documents.edit', compact('document','categories'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'file_path' => 'nullable|file',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:document_categories,id',
        ]);

        if ($request->hasFile('file_path')) {
            Storage::delete($document->file_path);
            $filePath = $request->file('file_path')->store('documents');
            $document->file_path = $filePath;
        }

        $document->update($request->except('file_path'));

        return redirect()->route('admin.documents')->with('success', 'Document updated successfully.');
    }

    public function destroy($document_id)
    {
        $document = Document::findOrFail($document_id);

        Storage::delete($document->file_path);
        $document->delete();
        $sms = ['status' => 'error', 'sms' => __('Delete Fail')];
        if ($document) {
            $sms = ['status' => 'success', 'sms' => __('Delete Succesffully')];
        }
        return redirect()->route('admin.documents')->with($sms);
    }

    public function download($document_id)
    {
        $document = Document::findOrFail($document_id);
        if (Storage::exists($document->file_path)) {
            return Storage::download($document->file_path);
        }

        return redirect()->route('admin.documents')->with(['status' => 'error', 'sms' => 'File not found.']);
    }

    public function evaluations(Request $request, $document_id)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $document = Document::findOrFail($document_id);
        $document->evaluations()->create([
            'text' => $request->text,
            'user_id' => auth()->id(),
        ]);


        return redirect()->route('admin.documents.show', $document_id)->with('success', 'Evaluation added successfully.');
    }
}
