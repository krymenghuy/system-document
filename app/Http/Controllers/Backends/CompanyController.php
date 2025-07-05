<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(){
        $data['company'] = DB::table('companies')->find(1);

        return view('backends.company.index', $data);
    }
    public function edit(){
        $data['company'] = DB::table('companies')->find(1);

        return view('backends.company.edit', $data);
    }
    public function update(Request $r){

        $data= $r->except('_token');
        $old = DB::table('companies')->find(1);

        if($r->hasFile('photo')){
            if($old->photo && Storage::disk('custom')->exists($old->photo)){
                Storage::disk('custom')->delete($old->photo);
            }
            $data['photo'] = $r->file('photo')->store('images/company','custom');
        }


        $u = DB::table('companies')->where('id',1)->update($data);

        $sms = ['status' => 'error', 'sms' => __('Update Fail')];
        if($u){
            $sms = ['status' => 'success', 'sms' => __('Update Successfully')];
        }


        return redirect()->route('admin.company')->with($sms);
    }
}
