@extends('layout')

@section('app-title', 'Додавання тварини')

@section('page-content')

    <h4>Створення тварини</h4>

    <form method="POST" action="{{ route('animals.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="form-group mb-2">
            <label for="name" class="form-label">Ім’я тварини</label>
            <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                placeholder="Ім’я тварини" value="{{ old('name') }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('name') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="type" class="form-label">Тип тварини</label>
            <input name="type" type="text" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" id="type"
                placeholder="Тип тварини" value="{{ old('type') }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('type') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="breed" class="form-label">Порода</label>
            <input name="breed" type="text" class="form-control {{ $errors->has('breed') ? 'is-invalid' : '' }}" id="breed"
                placeholder="Порода тварини" value="{{ old('breed') }}">

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

                <option value="Хлопчик" {{ old('gender') == 'Хлопчик' ? 'selected' : '' }}>
                    Хлопчик
                </option>

                <option value="Дівчинка" {{ old('gender') == 'Дівчинка' ? 'selected' : '' }}>
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

                <option value="Шукає дім" {{ old('status') == 'Шукає дім' ? 'selected' : '' }}>
                    Шукає дім
                </option>

                <option value="Прилаштовано" {{ old('status') == 'Прилаштовано' ? 'selected' : '' }}>
                    Прилаштовано
                </option>

                <option value="На лікуванні" {{ old('status') == 'На лікуванні' ? 'selected' : '' }}>
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
                placeholder="Вік тварини" value="{{ old('age') }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('age') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="description" class="form-label">Опис тварини</label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                id="description" placeholder="Опис тварини">{{ old('description') }}</textarea>

            <div class="invalid-feedback">
                @foreach ($errors->get('description') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="image">Виберіть фото тварини</label>
            <input name="image" type="file" id="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('image') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary float-end">Створити</button>

    </form>

@endsection