<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HelpRequest;
use Illuminate\Support\Facades\Auth;

class HelpRequestController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'help_type' => 'required|in:Фінансова підтримка,Корм та ліки,Волонтерство,Інформаційна підтримка',
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required|min:8|max:20',
            'email' => 'required|email|max:100',
            'message' => 'required|min:10|max:2000'
        ];

        $messages = [
            'help_type.required' => 'Оберіть тип допомоги.',
            'help_type.in' => 'Некоректний тип допомоги.',
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

        HelpRequest::create([
            'help_type' => $request->help_type,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'Нова'
        ]);

        return redirect()->back()->with('success', 'Заявку на допомогу успішно надіслано!');
    }

    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $query = HelpRequest::query();

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $helpRequests = $query->orderBy('id', 'desc')->get();

        return view('help_requests', compact('helpRequests'));
    }

    public function update($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }
        $helpRequest = HelpRequest::findOrFail($id);

        if ($helpRequest->status == 'Нова') {
            $helpRequest->status = 'В обробці';
        } elseif ($helpRequest->status == 'В обробці') {
            $helpRequest->status = 'Виконано';
        } else {
            $helpRequest->status = 'Нова';
        }

        $helpRequest->save();

        return redirect()->back();
    }
    public function destroy($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $helpRequest = HelpRequest::findOrFail($id);

        $helpRequest->delete();

        return redirect()->back();
    }
}