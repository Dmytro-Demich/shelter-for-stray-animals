@extends('layout')

@section('app-title', 'Редагування профілю')

@section('page-content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-header">
                Редагування профілю
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('profile.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Ім’я
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               value="{{ old('email', $user->email) }}">
                    </div>

                    <hr>

                    <p class="text-muted">
                        Якщо не хочете змінювати пароль, залиште поля порожніми.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Новий пароль
                        </label>

                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Підтвердження нового пароля
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('profile.index') }}"
                           class="btn btn-secondary">
                            Назад
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            Зберегти зміни
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection