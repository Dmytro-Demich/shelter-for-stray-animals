@extends('layout')

@section('app-title', 'Контакти')

@section('page-content')

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold">Контакти</h1>
        <p class="fs-4">
            Зв’яжіться з нами для допомоги, усиновлення чи співпраці.
        </p>
    </div>
</div>

<div class="row g-4">

    <div class="col-md-6">
        <div class="p-4 border rounded h-100">
            <h3>📍 Адреса</h3>
            <p>м. Хмельницький, вул. Добра, 15</p>

            <h3>📞 Телефон</h3>
            <p>+380 67 123 45 67</p>

            <h3>📧 Email</h3>
            <p>help@dobrilapy.ua</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 border rounded h-100">
            <h3>🕒 Години роботи</h3>
            <p>Пн-Пт: 09:00 – 18:00</p>
            <p>Сб-Нд: 10:00 – 16:00</p>

            <h3>🌐 Соціальні мережі</h3>
            <p>Facebook | Instagram | Telegram</p>
        </div>
    </div>

</div>

@endsection