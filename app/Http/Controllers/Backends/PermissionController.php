<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class PermissionController extends Controller
{
    public function index(){
        $data['permissions'] = DB::table('permissions')->get();
        return view('backends.permissions.index', $data);
    }
    public function create(){

        return view('backends.permissions.create');
    }
    public function store(Request $r){
         $validator = Validator::make($r->all(),[
            'name' => 'required',
            'key' => 'required'
         ]);

         if($validator->fails()){
            return redirect()->back()->with(['status' => 'errors', 'data' => $validator->errors() ]);
         }

         try {
            $i = DB::table('permissions')->insert([
                'name' => $r->name,
                'alias' => $r->key
            ]);

            if($i){
                return redirect()->route('admin.permission')->with(['status' => 'success', 'sms' => __('Insert Successfully')]);
            }

            return redirect()->route('admin.permission')->with(['status' => 'error', 'sms' => __('Insert Fail')]);

         } catch (\Throwable $e) {
            //throw $th;
            return redirect()->route('admin.permission')->with(['status' => 'error', 'sms' => __('Something wrong')]);
         }
    }

    public function edit($permission_id){

        $permission_id = base64_decode($permission_id);
        $data['permission'] = DB::table('permissions')->find($permission_id);

        if(!$data['permission']){
            return redirect()->back()->with(['status' => 'warning', 'sms' => 'Not Found']);
        }

        return view('backends.permissions.edit',$data);
    }

    public function update(Request $r, $permission_id){
        $validator = Validator::make($r->all(),[
            'name' => 'required',
            'key' => 'required'
         ]);

         if($validator->fails()){
            return redirect()->back()->with(['status' => 'errors', 'data' => $validator->errors() ]);
         }

         try {
            $u = DB::table('permissions')->where('id', $permission_id)->update([
                'name' => $r->name,
                'alias' => $r->key
            ]);


            if($u){
                return redirect()->route('admin.permission')->with(['status' => 'success', 'sms' => __('Update Successfully')]);
            }

            return redirect()->route('admin.permission')->with(['status' => 'error', 'sms' => __('Update Fail')]);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.permission')->with(['status' => 'error', 'sms' => __('Something Wrong')]);
         }

    }

    public function delete($permission_id){

        try {
            $d = DB::table('permissions')->where('id', $permission_id)->delete();
            if($d){
                return redirect()->route('admin.permission')->with(['status' => 'success', 'sms' => __('Delete Successfully')]);
            }

            return redirect()->route('admin.permission')->with(['status' => 'error', 'sms' => __('Delete Fail')]);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.permission')->with(['status' => 'error', 'sms' => __('Something Wrong')]);
        }
    }
}