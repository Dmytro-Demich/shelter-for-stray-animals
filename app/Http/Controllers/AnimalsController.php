<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AnimalsController extends Controller
{


    public function getList()
    {
        $query = Animal::query();

        if (request('type')) {
            $query->where('type', request('type'));
        }

        if (request('breed')) {
            $query->where('breed', request('breed'));
        }

        if (request('gender')) {
            $query->where('gender', request('gender'));
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('sort') == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif (request('sort') == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif (request('sort') == 'status') {
            $query->orderBy('status', 'asc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $animals = $query->paginate(3)->withQueryString();

        return view('animals')
            ->with('animals', $animals)
            ->with('pageTitle', 'Наші тварини');
    }
    public function show($id)
    {
        $animal = Animal::with('images')->find($id);

        return view('animal')
            ->with('animal', $animal);
    }

    public function create()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        return view('animals/create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'type' => 'required|regex:/^[\pL\s\-]+$/u',
            'age' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'breed' => 'required|regex:/^[\pL\s\-]+$/u',
            'gender' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'name.required' => 'Ім’я тварини не може бути пустим.',
            'name.regex' => 'Ім’я тварини повинно містити лише літери.',
            'type.required' => 'Тип тварини не може бути пустим.',
            'type.regex' => 'Тип тварини повинен містити лише літери.',
            'age.required' => 'Вік тварини не може бути пустим.',
            'description.required' => 'Опис тварини не може бути пустим.',
            'image.required' => 'Оберіть фото тварини.',
            'image.image' => 'Файл повинен бути зображенням.',
            'breed.required' => 'Порода тварини не може бути пустим',
            'breed.regex' => 'Порода тварини повинна містити лише літери.',
            'gender.required' => 'Оберіть стать тварини.',
            'status.required' => 'Оберіть статус тварини.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('animals.create')
                ->withErrors($validator)
                ->withInput();
        }

        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $imageName);

        Animal::create([
            'name' => $request->name,
            'type' => $request->type,
            'breed' => $request->breed,
            'gender' => $request->gender,
            'age' => $request->age,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect('/animals');
    }

    public function edit($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $animal = Animal::find($id);

        return view('animals.edit')->with('animal', $animal);
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'type' => 'required|regex:/^[\pL\s\-]+$/u',
            'breed' => 'required|regex:/^[\pL\s\-]+$/u',
            'gender' => 'required',
            'age' => 'required',
            'status' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'Ім’я тварини не може бути пустим.',
            'name.regex' => 'Ім’я тварини повинно містити лише літери.',
            'type.required' => 'Тип тварини не може бути пустим.',
            'type.regex' => 'Тип тварини повинен містити лише літери.',
            'age.required' => 'Вік тварини не може бути пустим.',
            'description.required' => 'Опис тварини не може бути пустим.',
            'breed.required' => 'Порода тварини не може бути пустим',
            'breed.regex' => 'Порода тварини повинна містити лише літери.',
            'gender.required' => 'Оберіть стать тварини.',
            'status.required' => 'Оберіть статус тварини.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('animals.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $animal = Animal::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $random_name = Str::random(8);
            $destinationPath = public_path('images/');
            $extension = $file->getClientOriginalExtension();
            $filename = $random_name . '_animal.' . $extension;

            $request->file('image')->move($destinationPath, $filename);

            $animal->image = $filename;
        }

        $animal->name = $request->input('name');
        $animal->type = $request->input('type');
        $animal->breed = $request->input('breed');
        $animal->gender = $request->input('gender');
        $animal->age = $request->input('age');
        $animal->status = $request->input('status');
        $animal->description = $request->input('description');

        $animal->save();

        return redirect('/animals');
    }

    public function destroy($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isManager()) {
            abort(403);
        }

        $animal = Animal::find($id);

        $animal->delete();

        return redirect('/animals');
    }

    public function index()
    {
        return $this->getList();
    }
}