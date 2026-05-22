@extends('layout')

@section('app-title', 'Заявки на усиновлення')

@section('page-content')

<h1 class="mb-4">Заявки на усиновлення</h1>

<form method="GET" action="/applications" class="mb-4 d-flex gap-2">

    <select name="status" class="form-control" style="max-width: 250px;">
        <option value="">Всі статуси</option>

        <option value="Нова" {{ request('status') == 'Нова' ? 'selected' : '' }}>
            Нова
        </option>

        <option value="В обробці" {{ request('status') == 'В обробці' ? 'selected' : '' }}>
            В обробці
        </option>

        <option value="Схвалено" {{ request('status') == 'Схвалено' ? 'selected' : '' }}>
            Схвалено
        </option>
    </select>

    <button type="submit" class="btn btn-primary">
        Фільтрувати
    </button>

    <a href="/applications" class="btn btn-secondary">
        Скинути
    </a>

</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Тварина</th>
            <th>Ім’я</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Повідомлення</th>
            <th>Статус</th>
            <th>Дата</th>
            <th>Видалити</th>
        </tr>
    </thead>

    <tbody>
        @foreach($applications as $application)
            <tr>
                <td>{{ $application->animal->name }}</td>
                <td>{{ $application->name }}</td>
                <td>{{ $application->phone }}</td>
                <td>{{ $application->email }}</td>
                <td>{{ $application->message }}</td>

                <td>
                    <form method="POST" action="{{ route('applications.update', $application->id) }}">
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-sm
                            @if($application->status == 'Нова')
                                btn-primary
                            @elseif($application->status == 'В обробці')
                                btn-warning
                            @else
                                btn-success
                            @endif"
                        >
                            {{ $application->status }}
                        </button>
                    </form>
                </td>

                <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>

                <td>
                    <form method="POST" action="{{ route('applications.destroy', $application->id) }}">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Видалити заявку?')"
                        >
                            Видалити
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection