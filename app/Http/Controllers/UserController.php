<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $users = User::with('roles')->get();

        return view('users', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $role = Role::where('name', $request->role)->first();

        if ($role) {
            $user->roles()->sync([$role->id]);
        }

        return redirect()->back();
    }
}