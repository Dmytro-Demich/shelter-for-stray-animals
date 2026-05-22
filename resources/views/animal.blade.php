@extends('layout')

@section('app-title', $animal->name)

@section('page-content')

    @php
        $allImages = collect([$animal->image]);

        foreach ($animal->images as $img) {
            if (!$allImages->contains($img->image)) {
                $allImages->push($img->image);
            }
        }
    @endphp

    <div class="row g-5">

        <div class="col-md-6">

            <div id="animalCarousel" class="carousel slide" data-bs-ride="false">

                <div class="carousel-inner rounded shadow-sm">

                    @foreach($allImages as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="/images/{{ $image }}" class="d-block w-100" alt="{{ $animal->name }}"
                                style="height: 500px; object-fit: cover;">
                        </div>
                    @endforeach

                </div>

                @if($allImages->count() > 1)

                    <button class="carousel-control-prev" type="button" data-bs-target="#animalCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#animalCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                @endif

            </div>

        </div>

        <div class="col-md-6">

            <h1 class="display-4 fw-bold">{{ $animal->name }}</h1>

            <p class="fs-5 text-muted mb-4">
                {{ $animal->description }}
            </p>

            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">
                    <strong>Тип:</strong> {{ $animal->type }}
                </li>

                <li class="list-group-item">
                    <strong>Порода:</strong> {{ $animal->breed ?? 'Невідома' }}
                </li>

                <li class="list-group-item">
                    <strong>Стать:</strong> {{ $animal->gender ?? 'Не вказано' }}
                </li>

                <li class="list-group-item">
                    <strong>Вік:</strong> {{ $animal->age }}
                </li>

                <li class="list-group-item">
                    <strong>Статус:</strong> {{ $animal->status }}
                </li>
            </ul>

            <div class="d-flex gap-3">
                <a href="/animals" class="btn btn-secondary">
                    Назад до тварин
                </a>

                @auth
                    @if(Auth::user()->isAdmin())

                        <a href="{{ route('animals.images.create', $animal) }}" class="btn btn-outline-primary">
                            Додати фото
                        </a>

                    @endif
                @endauth

                <a href="/help" class="btn btn-primary">
                    Допомогти
                </a>
            </div>



        </div>

    </div>

    <hr class="my-5">

    <h3>Подати заявку на усиновлення</h3>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('applications.store') }}" novalidate>
        @csrf

        <input type="hidden" name="animal_id" value="{{ $animal->id }}">

        <div class="card shadow-sm p-3 mt-4">
            <label for="name" class="form-label">Ваше ім’я</label>

            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('name') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="card shadow-sm p-3 mt-4">
            <label for="phone" class="form-label">Телефон</label>

            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('phone') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="card shadow-sm p-3 mt-4">
            <label for="email" class="form-label">Email</label>

            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

            <div class="invalid-feedback">
                @foreach ($errors->get('email') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="card shadow-sm p-3 mt-4">
            <label for="message" class="form-label">Повідомлення</label>

            <textarea name="message" id="message" rows="4"
                class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') }}</textarea>

            <div class="invalid-feedback">
                @foreach ($errors->get('message') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary btn-lg">
                Подати заявку
            </button>
        </div>
    </form>

@endsection