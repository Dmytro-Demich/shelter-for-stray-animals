<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $query = Application::with('animal');

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $applications = $query->orderBy('id', 'desc')->get();

        return view('applications', compact('applications'));
    }

    public function store(Request $request)
    {
        $rules = [
            'animal_id' => 'required|exists:animals,id',
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required|min:8|max:20',
            'email' => 'required|email|max:100',
            'message' => 'required|min:10|max:2000'
        ];

        $messages = [
            'animal_id.required' => 'Не обрано тварину.',
            'animal_id.exists' => 'Такої тварини не існує.',

            'name.required' => 'Вкажіть ваше ім’я.',
            'name.min' => 'Ім’я повинно містити мінімум 2 символи.',
            'name.max' => 'Ім’я не повинно перевищувати 50 символів.',
            'name.regex' => 'Ім’я повинно містити лише літери.',

            'phone.required' => 'Вкажіть номер телефону.',
            'phone.min' => 'Телефон вказано некоректно.',
            'phone.max' => 'Телефон вказано некоректно.',

            'email.required' => 'Вкажіть email.',
            'email.email' => 'Некоректний email.',

            'message.required' => 'Напишіть повідомлення.',
            'message.min' => 'Повідомлення повинно містити мінімум 10 символів.',
            'message.max' => 'Повідомлення занадто довге.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Application::create([
            'animal_id' => $request->animal_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'Нова'
        ]);

        return redirect()->back()->with('success', 'Заявку успішно подано!');
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $application = Application::findOrFail($id);

        if ($application->status == 'Нова') {
            $application->status = 'В обробці';
        } elseif ($application->status == 'В обробці') {
            $application->status = 'Схвалено';
        } else {
            $application->status = 'Нова';
        }

        $application->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }
        $application = Application::findOrFail($id);

        $application->delete();

        return redirect()->back();
    }
}