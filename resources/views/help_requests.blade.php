@extends('layout')

@section('app-title', 'Заявки на допомогу')

@section('page-content')

    <h1 class="mb-4">Заявки на допомогу</h1>

    <form method="GET" action="/help_requests" class="mb-4 d-flex gap-2">

        <select name="status" class="form-control" style="max-width: 250px;">
            <option value="">Всі статуси</option>

            <option value="Нова" {{ request('status') == 'Нова' ? 'selected' : '' }}>
                Нова
            </option>

            <option value="В обробці" {{ request('status') == 'В обробці' ? 'selected' : '' }}>
                В обробці
            </option>

            <option value="Виконано" {{ request('status') == 'Виконано' ? 'selected' : '' }}>
                Виконано
            </option>
        </select>

        <button type="submit" class="btn btn-primary">
            Фільтрувати
        </button>

        <a href="/help_requests" class="btn btn-secondary">
            Скинути
        </a>

    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Тип допомоги</th>
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
            @foreach($helpRequests as $request)
                <tr>
                    <td>{{ $request->help_type }}</td>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->phone }}</td>
                    <td>{{ $request->email }}</td>
                    <td>{{ $request->message }}</td>
                    <td>
                        <form method="POST" action="{{ route('help_requests.update', $request->id) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-sm
                                @if($request->status == 'Нова')
                                    btn-primary
                                @elseif($request->status == 'В обробці')
                                    btn-warning
                                @else
                                    btn-success
                                @endif
                                ">
                                {{ $request->status }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $request->created_at->format('d.m.Y H:i') }} </td>
                    <td>
                        <form method="POST" action="{{ route('help_requests.destroy', $request->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Видалити заявку?')">
                                Видалити
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection