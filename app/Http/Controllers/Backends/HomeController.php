<?php

namespace App\Http\Controllers\Backends;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $role = auth()->user()->role;
        $role_id = DB::table('roles')->where('value', $role)->first()?->id;
        $permission = DB::table('permissions')->where('alias', 'dashboard')->first();
<<<<<<< HEAD

        $role_permission = DB::table('role_permissions')->where(['role_id' => $role_id, 'permission_id' => $permission->id])->first();
        if (!$role_permission || $role_permission->views == 0) {
=======
       
        $role_permission = DB::table('role_permissions')->where(['role_id' => $role_id, 'permission_id' => $permission->id])->first();
        if ($role_permission->views == 0) {
>>>>>>> 9a9aa51486357edfe72c6b3321aafa5821e401bf
            return redirect()->route('admin.documents');
        }

        $data['total_Document'] = DB::table('documents')->count();
        $data['total_DocumentCategory'] = DB::table('document_categories')->count();
        $data['total_User'] = DB::table('users')->count();
        //    $data['total_Role'] = DB::table('roles')->count();
        $data['total_Permission'] = DB::table('permissions')->count();
        $data['total_Role'] = DB::table('roles')->count();
        $data['total_Role'] = DB::table('roles')->count();
        $data['total_pomission'] = DB::table('permissions')->count();
        // $total_Document = Document::count();

        return view('backends.home.index', $data);
    }
    public function test(request $r)
    {


        return redirect()->route('admin.document.category')->with(['status' => 'Success', 'sms' => 'Login Fail']);
    }
}
