<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function login(Request $r)
    {
        $username = $r->username;

        $user = ModelsUser::where('username', $username)->first();
        if ($user) {
            if (Hash::check($r->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('admin.home');
            } else {
                return redirect()->back()->with('error', 'Username or password is incorrect');
            }
        } else {
            return redirect()->back()->with('error', 'Username or password is incorrect');
        }

        if (Auth::check()) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with('error', 'Username or password is incorrect');
        }
    }
}
