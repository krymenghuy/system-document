<?php

namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentCategoryController extends Controller
{
    public function index()
    {

        $data['document_categories'] = DB::table('document_categories')->paginate(3);

        return view('backends.document_categories.index', $data);
    }

    public function create()
    {
        return view('backends.document_categories.create');
    }

    public function store(Request $r)
    {
        $data = [
            'name' => $r->name,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $i = DB::table('document_categories')->insert($data);

        $sms = ['status' => 'error', 'sms' => __('Insert Fail')];
        if ($i) {
            $sms = ['status' => 'success', 'sms' => __('Insert Succesffully')];
        }

        return redirect()->route('admin.document_category')->with($sms);
    }

    public function edit($document_category_id)
    {
        $data['document_category'] = DB::table('document_categories')->find($document_category_id);

        if (!$data['document_category']) {
            return redirect()->route('admin.document.category')->with(['status' => 'warning', 'sms' => "Not Found"]);
        }

        return view('backends.document_categories.edit', $data);
    }

    public function update(Request $r, $document_category_id)
    {
        $find = DB::table('document_categories')->find($document_category_id);
        if (!$find) {
            return redirect()->route('admin.document.category')->with(['status' => 'warning', 'sms' => "Not Found"]);
        }

        $u = DB::table('document_categories')->where('id', $document_category_id)->update([
            'name' => $r->name,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $sms = ['status' => 'error', 'sms' => __('Update Fail')];
        if ($u) {
            $sms = ['status' => 'success', 'sms' => __('Update Succesffully')];
        }

        return redirect()->route('admin.document_category')->with($sms);
    }


    public function delete($document_category_id)
    {
        $find = DB::table('document_categories')->find($document_category_id);

        if (!$find) {
            return redirect()->route('admin.document_category')->with(['status' => 'warning', 'sms' => "Not Found"]);
        }

        $d = DB::table('document_categories')->where('id', $document_category_id)->delete();

        $sms = ['status' => 'error', 'sms' => __('Delete Fail')];
        if ($d) {
            $sms = ['status' => 'success', 'sms' => __('Delete Succesffully')];
        }

        return redirect()->route('admin.document_category')->with($sms);
    }
}





// public function edit($document_id)
// {
//     $data['document'] = DB::table('documents')->find($document_id);

//     if (!$data['document']) {
//         return redirect()->route('admin.document')->with(['status' => 'warning', 'sms' => "Not Found"]);
//     }

//     return view('backends.documents.edit', $data);
// }

// public function update(Request $r, $document_id)
// {
//     $find = DB::table('documents')->find($document_id);
//     if (!$find) {
//         return redirect()->route('admin.document')->with(['status' => 'warning', 'sms' => "Not Found"]);
//     }

//     $u = DB::table('documents')->where('id', $document_id)->update([
//         'name' => $r->name,
//         'updated_at' => date('Y-m-d H:i:s'),
//     ]);

//     $sms = ['status' => 'error', 'sms' => __('Update Fail')];
//     if ($u) {
//         $sms = ['status' => 'success', 'sms' => __('Update Succesffully')];
//     }

//     return redirect()->route('admin.documents')->with($sms);
// }