<?php

// checkPermission('product','edit')

use Illuminate\Support\Facades\DB;

function checkPermission($permission_key, $action)
{
    $role = auth()->user()->role;

    $role_id = DB::table('roles')->where('value', $role)->first()?->id;
    if (!$role_id) {
        return false;
    }

    $permission = DB::table('permissions')->where('alias', $permission_key)->first();
    if (!$permission) {
        return false;
    }

    $role_permission = DB::table('role_permissions')->where(['role_id' => $role_id, 'permission_id' => $permission->id])->first();
    if (!$role_permission) {
        return false;
    }

    if ($action == 'view') {
        return $role_permission->views == 1 ? true : false;
    } else if ($action == 'create') {
        return $role_permission->insert == 1 ? true : false;
    } else if ($action == 'edit') {
        return $role_permission->update == 1 ? true : false;
    } else if ($action == 'delete') {
        return $role_permission->delete == 1 ? true : false;
    } else if ($action == 'download') {
        return $role_permission->download == 1 ? true : false;
    } else if ($action == 'show') {
        return $role_permission->show == 1 ? true : false;
    } else {
        return false;
    }

    return false;
}

function userAuth()
{
    $user_id = auth()->user()->id;
    $user = DB::table('users')->find($user_id);

    return $user;
}

function company()
{
    return DB::table('companies')->find(1);
}
function documentCategories()
{
    return DB::table('document_categories')->get();
}
function user_auth()
{
    $user_id = session()->get('user_auth')->id;
    return DB::table('user')->find($user_id);
}
?>