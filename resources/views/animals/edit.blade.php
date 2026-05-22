@extends('layout')

@section('app-title', 'Редагування тварини')

@section('page-content')

    <h4>Редагування тварини</h4>

    <form method="POST" action="{{ route('animals.update', $animal->id) }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PATCH')

        <div class="form-group mb-2">
            <label for="name" class="form-label">Ім’я тварини</label>
            <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                value="{{ old('name', $animal->name) }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('name') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="type" class="form-label">Тип тварини</label>
            <input name="type" type="text" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" id="type"
                value="{{ old('type', $animal->type) }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('type') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="breed" class="form-label">Порода</label>
            <input name="breed" type="text" class="form-control {{ $errors->has('breed') ? 'is-invalid' : '' }}" id="breed"
                value="{{ old('breed', $animal->breed) }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('breed') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="gender" class="form-label">Стать</label>
            <select name="gender" id="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">

                <option value="">Оберіть стать</option>

                <option value="Хлопчик" {{ old('gender', $animal->gender) == 'Хлопчик' ? 'selected' : '' }}>
                    Хлопчик
                </option>

                <option value="Дівчинка" {{ old('gender', $animal->gender) == 'Дівчинка' ? 'selected' : '' }}>
                    Дівчинка
                </option>
            </select>

            <div class="invalid-feedback">
                @foreach ($errors->get('gender') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="status" class="form-label">Статус</label>
            <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">

                <option value="Шукає дім" {{ old('status', $animal->status) == 'Шукає дім' ? 'selected' : '' }}>
                    Шукає дім
                </option>

                <option value="Прилаштовано" {{ old('status', $animal->status) == 'Прилаштовано' ? 'selected' : '' }}>
                    Прилаштовано
                </option>

                <option value="На лікуванні" {{ old('status', $animal->status) == 'На лікуванні' ? 'selected' : '' }}>
                    На лікуванні
                </option>
            </select>

            <div class="invalid-feedback">
                @foreach ($errors->get('status') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="age" class="form-label">Вік</label>
            <input name="age" type="text" class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" id="age"
                value="{{ old('age', $animal->age) }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('age') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="description" class="form-label">Опис тварини</label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                id="description">{{ old('description', $animal->description) }}</textarea>

            <div class="invalid-feedback">
                @foreach ($errors->get('description') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="image">Нове фото (необов'язково)</label>
            <input name="image" type="file" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary float-end">
            Зберегти зміни
        </button>

    </form>

    <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" class="mt-5">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">
            Видалити тварину
        </button>
    </form>

@endsection