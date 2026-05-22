@extends('layout')

@section('app-title', 'Додати фото')

@section('page-content')

<h4>Додати нове фото для {{ $animal->name }}</h4>

<form method="POST" action="{{ route('animals.images.store', $animal->id) }}" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="form-group mb-3">
        <label for="image">Файл зображення</label>
        <input name="image" type="file"
               id="image"
               class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">

        <div class="invalid-feedback">
            @foreach ($errors->get('image') as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="description" class="form-label">Опис фото</label>
        <textarea name="description"
                  class="form-control"
                  id="description"
                  placeholder="Опис фото">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary float-end">
        Додати фото
    </button>

</form>

@endsection