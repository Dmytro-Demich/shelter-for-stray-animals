@extends('layout')

@section('app-title', 'Користувачі')

@section('page-content')

    <h1 class="mb-4">
        Керування ролями користувачів
    </h1>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>Ім’я</th>
                <th>Email</th>
                <th>Поточна роль</th>
                <th>Змінити роль</th>
            </tr>
        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>
                        {{ $user->name }}
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>

                        @foreach($user->roles as $role)

                            <span class="badge bg-primary">
                                {{ $role->name }}
                            </span>

                        @endforeach

                    </td>

                    <td>
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="input-group">
                                <select name="role" class="form-select">
                                    <option value="user" {{ $user->roles->first()?->name == 'user' ? 'selected' : '' }}>
                                        Користувач
                                    </option>

                                    <option value="manager" {{ $user->roles->first()?->name == 'manager' ? 'selected' : '' }}>
                                        Менеджер
                                    </option>

                                    <option value="admin" {{ $user->roles->first()?->name == 'admin' ? 'selected' : '' }}>
                                        Адміністратор
                                    </option>
                                </select>

                                <button type="submit" class="btn btn-primary">
                                    Зберегти
                                </button>
                            </div>
                        </form>
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@endsection