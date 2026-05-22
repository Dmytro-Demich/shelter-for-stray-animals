@extends('layout')

@section('app-title', 'Добрі лапи')

@section('page-content')

        <h1 class="mb-4">Про притулок</h1>

        <div class="row">

            <div class="col-md-6 d-flex flex-column justify-content-center">
                <p>
                    Притулок "Добрі лапи" допомагає безпритульним тваринам, які опинилися на вулиці.
                    Ми забезпечуємо їм безпечне місце, догляд і необхідну медичну допомогу.
                </p>

                <p>
                    Окрім утримання тварин, ми активно працюємо над тим, щоб знайти для них нові домівки,
                    співпрацюємо з волонтерами та залучаємо людей до допомоги притулку.
                </p>

                <p>
                    Наша головна мета — не просто допомогти тваринам вижити, а дати їм шанс на повноцінне життя
                    у люблячій родині.
                </p>

                <h3 class="mt-4 fw-bold">Що ми робимо:</h3>
                <ul class="mt-3">
                    <li>Рятуємо безпритульних тварин</li>
                    <li>Забезпечуємо лікування</li>
                    <li>Шукаємо нових господарів</li>
                    <li>Працюємо з волонтерами</li>
                </ul>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <img src="/images/shelter.webp" class="img-fluid rounded shadow ms-4" alt="Притулок">
            </div>

        </div>

        <div class="row text-center mt-5 mb-5">

            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <div style="font-size: 42px;">🐶</div>
                    <h2 class="fw-bold mt-2 mb-2">150+</h2>
                    <p class="text-muted mb-0">врятованих тварин</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <div style="font-size: 42px;">🏡</div>
                    <h2 class="fw-bold mt-2 mb-2">80+</h2>
                    <p class="text-muted mb-0">знайшли новий дім</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <div style="font-size: 42px;">🤝</div>
                    <h2 class="fw-bold mt-2 mb-2">20+</h2>
                    <p class="text-muted mb-0">активних волонтерів</p>
                </div>
            </div>

        </div>

    </div>

@endsection