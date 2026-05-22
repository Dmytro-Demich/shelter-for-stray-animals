@extends('layout')

@section('app-title', 'Добрі лапи')

@section('page-content')

    <h1 class="mb-4">{{ $pageTitle }}</h1>

    @auth
        @if(Auth::user()->isAdmin())

            <a href="{{ route('animals.create') }}" class="btn btn-primary">
                Додати тварину
            </a>

        @endif
    @endauth

    <form method="GET" action="/animals" class="row g-3 mb-4 align-items-end">

        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Пошук за ім’ям"
                value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <input type="text" name="type" class="form-control" placeholder="Тип" value="{{ request('type') }}">
        </div>

        <div class="col-md-2">
            <input type="text" name="breed" class="form-control" placeholder="Порода" value="{{ request('breed') }}">
        </div>

        <div class="col-md-2">
            <select name="gender" class="form-control">
                <option value="">Стать</option>
                <option value="Хлопчик" {{ request('gender') == 'Хлопчик' ? 'selected' : '' }}>Хлопчик</option>
                <option value="Дівчинка" {{ request('gender') == 'Дівчинка' ? 'selected' : '' }}>Дівчинка</option>
            </select>
        </div>

        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">Статус</option>
                <option value="Шукає дім" {{ request('status') == 'Шукає дім' ? 'selected' : '' }}>Шукає дім</option>
                <option value="Прилаштовано" {{ request('status') == 'Прилаштовано' ? 'selected' : '' }}>Прилаштовано</option>
                <option value="На лікуванні" {{ request('status') == 'На лікуванні' ? 'selected' : '' }}>На лікуванні</option>
            </select>
        </div>

        <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-primary">
                Пошук
            </button>
        </div>

        <div class="col-md-2">
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                    По:
                    @if(request('sort') == 'name_asc')
                        імені А-Я
                    @elseif(request('sort') == 'name_desc')
                        імені Я-А
                    @elseif(request('sort') == 'status')
                        статусу
                    @else
                        новизні
                    @endif
                </button>

                <ul class="dropdown-menu dropdown-menu-dark w-100">
                    <li>
                        <h6 class="dropdown-header">Сортувати по</h6>
                    </li>

                    <li>
                        <a class="dropdown-item {{ request('sort') == '' ? 'active' : '' }}"
                            href="{{ request()->fullUrlWithQuery(['sort' => null]) }}">
                            Новизні
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item {{ request('sort') == 'name_asc' ? 'active' : '' }}"
                            href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">
                            Імені А-Я
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item {{ request('sort') == 'name_desc' ? 'active' : '' }}"
                            href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">
                            Імені Я-А
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item {{ request('sort') == 'status' ? 'active' : '' }}"
                            href="{{ request()->fullUrlWithQuery(['sort' => 'status']) }}">
                            Статусу
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-1 d-grid">
            <a href="/animals" class="btn btn-secondary">
                Скинути
            </a>
        </div>

    </form>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

        @foreach($animals as $animal)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <img src="/images/{{ $animal->image }}" class="card-img-top" alt="{{ $animal->type }}"
                        style="height: 280px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h3>{{ $animal->name }}</h3>
                        <p class="card-text">{{ $animal->description }}</p>
                        <p class="card-text">Вік: {{ $animal->age }}</p>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/animals/{{ $animal->id }}" class="btn btn-sm btn-outline-secondary">Переглянути</a>
                               @auth
                                    @if(Auth::user()->isAdmin())

                                        <a href="{{ route('animals.edit', $animal) }}"
                                        class="btn btn-outline-secondary">
                                        Редагувати</a>
                                    @endif
                                @endauth
                            </div>
                            <small class="text-muted">{{ $animal->type }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="mt-4">
        {{ $animals->links() }}
    </div>

@endsection