@extends('layout')

@section('app-title', 'Новини')

@section('page-content')

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold">Новини притулку</h1>
        <p class="fs-4">
            Останні події, історії порятунку та успіхи наших підопічних.
        </p>
    </div>
</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h4>🐾 Барсик знайшов новий дім</h4>
                <p>Наш лагідний кіт Барсик успішно переїхав до нової родини.</p>
                <small class="text-muted">Квітень 2026</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h4>🏥 Нове ветеринарне обладнання</h4>
                <p>Завдяки підтримці небайдужих ми закупили необхідні ліки та обладнання.</p>
                <small class="text-muted">Березень 2026</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h4>🎉 Благодійна акція</h4>
                <p>Проведено збір корму та речей для безпритульних тварин.</p>
                <small class="text-muted">Лютий 2026</small>
            </div>
        </div>
    </div>

</div>

@endsection