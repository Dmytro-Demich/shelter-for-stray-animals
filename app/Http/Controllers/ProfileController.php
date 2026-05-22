<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed'
        ];

        $messages = [
            'name.required' => 'Вкажіть ім’я.',
            'name.min' => 'Ім’я повинно містити мінімум 2 символи.',
            'name.max' => 'Ім’я не повинно перевищувати 50 символів.',
            'name.regex' => 'Ім’я повинно містити лише літери.',

            'email.required' => 'Вкажіть email.',
            'email.email' => 'Некоректний email.',
            'email.unique' => 'Такий email вже використовується.',

            'password.min' => 'Пароль має містити мінімум 8 символів.',
            'password.confirmed' => 'Паролі не співпадають.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/profile')
            ->with('success', 'Профіль оновлено!');
    }
}