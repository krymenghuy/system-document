<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Validator;
use Storage;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = DB::table('users')
            ->join('roles', 'roles.value', 'users.role')
            ->select('users.*', 'roles.name as role_name')
            ->paginate(10);
        return view('backends.user.index', $data);
    }

    public function create()
    {
        $data['roles'] = DB::table('roles')->get();
        return view('backends.user.create', $data);
    }
    public function store(Request $r)
    {
        $validation = Validator::make($r->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|min:8',
        ]);

        if ($validation->fails()) {
            return redirect()->route('admin.user')->with(['status' => 'errors', 'data' => $validation->errors()]);
        }

        $name = $r->name;
        $username = $r->username;
        $password = Hash::make($r->password);
        $email = $r->email;
        $role = $r->role;

        $i = DB::table('users')->insert([
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'role' => $role,
            'photo' => $r->hasFile('photo') ? $r->file('photo')->store('images/photo', 'custom') : null
        ]);

        if ($i == true) {
            return redirect()->route('admin.user')->with(['status' => 'success', 'sms' => __('Insert Successfully')]);
        } else {
            return redirect()->route('admin.user')->with(['status' => 'error', 'sms' => __('Insert Fails')]);
        }
    }

    public function edit($user_id)
    {

        $data['user'] = DB::table('users')->find($user_id);
        $data['roles'] = DB::table('roles')->get();

        return view('backends.user.Edit', $data);
    }


    public function update(Request $r, $user_id)
    {
        Validator::make($r->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'role' => 'required|string',
            'password' => 'nullable|min:8',
        ]);

        $data = [
            'name' => $r->name,
            'username' => $r->name,
            'email' => $r->email,
            'role' => $r->role
        ];
        $oldUser = DB::table('users')->find($user_id);
        if ($r->password) {
            $data['password'] = Hash::make($r->password);
        }
        if ($r->hasFile('photo')) {
            if (Storage::disk('custom')->exists($oldUser->photo)) {
                Storage::disk('custom')->delete($oldUser->photo);
            }
            $data['photo'] = $r->file('photo')->store('images/photo', 'custom');
        }

        $u = DB::table('users')->where('id', $user_id)->update($data);

        if ($u == true) {
            return redirect()->route('admin.user')->with(['status' => 'success', 'sms' => __('Update Successfully')]);
        } else {
            return redirect()->route('admin.user')->with(['status' => 'warning', 'sms' => __('No Update')]);
        }
    }


    public function delete($user_id){
    $old = DB::table('users')->find($user_id);

    if(Storage::disk('custom')->exists($old->photo)){
        Storage::disk('custom')->delete($old->photo);
    }
    
        $d = DB::table('users')->where('id', $user_id)->delete();
        if ($d) {
            return redirect()->route('admin.user')->with(['status' => 'success', 'sms' => __('Delete Successfully')]);
        } else {
            return redirect()->route('admin.user')->with(['status' => 'warning', 'sms' => __('Delete Fail')]);
        }
    }
}
