@extends('layout')

@section('app-title', 'Профіль')

@section('page-content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">

                <span>
                    Профіль користувача
                </span>

                <div class="d-flex gap-2">

                    <a href="{{ route('profile.edit', Auth::id()) }}"
                       class="btn btn-primary btn-sm">

                        Редагувати

                    </a>

                    <a href="{{ route('logout') }}"
                       class="btn btn-outline-danger btn-sm"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                        Вийти

                    </a>

                    <form id="logout-form"
                          action="{{ route('logout') }}"
                          method="POST"
                          class="d-none">

                        @csrf

                    </form>

                </div>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <strong>Ім’я:</strong>

                    {{ $user->name }}

                </div>

                <div class="mb-3">

                    <strong>Email:</strong>

                    {{ $user->email }}

                </div>

                <div class="mb-3">

                    <strong>Роль:</strong>

                    @foreach($user->roles as $role)

                        <span class="badge bg-primary">
                            {{ $role->name }}
                        </span>

                    @endforeach

                </div>

                <div class="mb-3">

                    <strong>Дата реєстрації:</strong>

                    {{ $user->created_at->format('d.m.Y H:i') }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection