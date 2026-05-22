@extends('layout')

@section('app-title', 'Добрі лапи')

@section('page-content')

<div class="p-5 mb-5 bg-light rounded-3 shadow-sm">
    <div class="container-fluid py-5">

        <h1 class="display-4 fw-bold mb-3">
            🐾 Добрі лапи
        </h1>

        <p class="fs-4 mb-4">
            Притулок для тварин, які шукають новий дім,
            турботу та люблячих господарів.
        </p>

        <a href="/animals" class="btn btn-primary btn-lg">
            Переглянути тварин
        </a>

    </div>
</div>

<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">

            <div class="card-body">

                <h3 class="card-title">
                    🐶 Наші тварини
                </h3>

                <p class="card-text">
                    У притулку знаходяться собаки та коти,
                    які чекають на нову сім’ю.
                </p>

                <a href="/animals" class="btn btn-outline-primary">
                    Переглянути
                </a>

            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">

            <div class="card-body">

                <h3 class="card-title">
                    ❤️ Допомога притулку
                </h3>

                <p class="card-text">
                    Ви можете допомогти кормом,
                    ліками, волонтерством або фінансово.
                </p>

                <a href="/help" class="btn btn-outline-danger">
                    Допомогти
                </a>

            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">

            <div class="card-body">

                <h3 class="card-title">
                    📞 Контакти
                </h3>

                <p class="card-text">
                    Зв’яжіться з нами для усиновлення
                    або отримання додаткової інформації.
                </p>

                <a href="/contacts" class="btn btn-outline-success">
                    Контакти
                </a>

            </div>

        </div>
    </div>

</div>

<div class="p-4 bg-light rounded shadow-sm">

    <h2 class="mb-3">
        Чому це важливо?
    </h2>

    <p class="fs-5">
        Кожна тварина заслуговує на дім,
        любов та турботу. Наш притулок допомагає
        безпритульним тваринам отримати шанс
        на нове життя.
    </p>

</div>

@endsection