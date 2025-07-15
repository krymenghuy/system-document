<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        // $data['roles'] = DB::table('roles')->paginate(10);
        $data['roles'] = DB::table('roles')->where('id','!=', auth()->user()->id == 1 ? null : 1)->paginate(10);
        return view('backends.roles.index', $data);
    }
    public function create()
    {

        return view('backends.roles.create');
    }
    // <?php
    public function store(Request $r)
    {
        // Validate the request
        $r->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        DB::beginTransaction();
        try {
            $name = $r->name;
            $i = DB::table('roles')->insert([
                'name' => $name,
                'value' => \Str::slug($name),
                'created_at' => now(),
            ]);
            DB::commit();
            return redirect()->route('admin.role')->with(['status' => 'success', 'sms' => __('Insert Successfully')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.role')->with(['status' => 'error', 'sms' => __('Insert Fails: ') . $th->getMessage()]);
        }
    }

    public function edit($role_id)
    {
        $data['role'] = DB::table('roles')->find($role_id);

        return view('backends.roles.edit', $data);
    }

    public function update(Request $r, $role_id)
    {
        DB::beginTransaction();
        try {
            $role = DB::table('roles')->find($role_id);
            $users = DB::table('users')->where('role', $role->value)->get();
            DB::table('roles')->where('id', $role_id)->update([
                'name' => $r->name,
                'value' => \Str::slug($r->name),
                'updated_at' => now()
            ]);

            foreach ($users as $user) {
                DB::table('users')->where('id', $user->id)->update([
                    'role' => \Str::slug($r->name)
                ]);
            }
            DB::commit();
            return redirect()->route('admin.role')->with(['status' => 'success', 'sms' => __('Update Successfully')]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.role')->with(['status' => 'error', 'sms' => $e->getMessage()]);
        }
    }
    public function delete($role_id)
    {
        $find = DB::table('users')->where('id', $role_id)->exists();
        if ($find) {
            return redirect()->route('admin.role')->with(['status' => 'warning', 'sms' => __('This data is being used !!! Can not delete it, please delete every user which belongs to this role first')]);
        }
        $d = DB::table('roles')->where('id', $role_id)->delete();
        if ($d == true) {
            return redirect()->route('admin.role')->with(['status' => 'success', 'sms' => __('Delete Successfully')]);
        } else {
            return redirect()->route('admin.role')->with(['status' => 'warning', 'sms' => __('Delete Fail')]);
        }
    }

    public function permission($role_id)
    {
        $data['role_permissions'] = DB::table('permissions')
            ->leftJoinSub(DB::table("role_permissions")->where('role_id', $role_id), 't1', function ($join) {
                $join->on('t1.permission_id', 'permissions.id');
            })
            ->select(
                'permissions.*',
                DB::raw('IFNULL(t1.views,0) as views'),
                DB::raw('IFNULL(t1.insert,0) as store'),
                DB::raw('IFNULL(t1.update,0) as edit'),
                DB::raw('IFNULL(t1.delete,0) as remove'),
                DB::raw('IFNULL(t1.download,0) as download'),
                DB::raw('IFNULL(t1.show,0) as detail'),
                DB::raw('IFNULL(t1.id,0) as role_permission_id'),
            )
            ->get();

        $data['role_id'] = $role_id;

        return view('backends.roles.permissions.index', $data);
    }

    public function updatePermission(Request $r, $role_id)
    {

        DB::beginTransaction();
        try {
            $role_permission_name = $r->permission;
            $role_permission_id = $r->role_permission_id;
            $role_permission_value = $r->role_permission_value;

            $permission_id = $r->permission_id;

            // insert if no role permission id
            if ($role_permission_id == 0) {
                DB::table('role_permissions')->insert([
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                    'views' => $role_permission_name == 'views' ? $role_permission_value : 0,
                    'update' => $role_permission_name == 'edit' ? $role_permission_value : 0,
                    'insert' => $role_permission_name == 'store' ? $role_permission_value : 0,
                    'delete' => $role_permission_name == 'remove' ? $role_permission_value : 0,
                    'show' => $role_permission_name == 'show' ? $role_permission_value : 0,
                    'download' => $role_permission_name == 'download' ? $role_permission_value : 0
                ]);
            } else {
                $data = [];
                if ($role_permission_name == 'views') {
                    $data['views'] = $role_permission_value;
                } else if ($role_permission_name == 'edit') {
                    $data['update'] = $role_permission_value;
                } else if ($role_permission_name == 'store') {
                    $data['insert'] = $role_permission_value;
                } else if ($role_permission_name == 'show') {
                    $data['show'] = $role_permission_value;
                } else if ($role_permission_name == 'download') {
                    $data['download'] = $role_permission_value;
                } else {
                    $data['delete'] = $role_permission_value;
                }

                DB::table('role_permissions')->where([
                    'role_id' => $role_id,
                    'id' => $role_permission_id,
                    'permission_id' => $permission_id
                ])->update($data);
            }
            DB::commit();

            return redirect()->back()->with(['status' => 'success', 'sms' => __('Update Successfully')]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return redirect()->back()->with(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
