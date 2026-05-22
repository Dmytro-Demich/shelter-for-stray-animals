@extends('layout')

@section('app-title', 'Як допомогти')

@section('page-content')

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-4">
        <h1 class="display-5 fw-bold">Як допомогти притулку</h1>
        <p class="fs-4">
            Ви можете підтримати наш притулок різними способами:
        </p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row g-4">

    <div class="col-md-6">
        <div class="p-4 border rounded h-100 shadow-sm help-card"
             data-bs-toggle="modal"
             data-bs-target="#helpModal"
             data-help-type="Фінансова підтримка"
             style="cursor: pointer;">
            <h3>💳 Фінансова підтримка</h3>
            <p>Допоможіть оплатити лікування, корм та догляд за тваринами.</p>
            <p><strong>IBAN:</strong> UA123456789012345678901234567</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 border rounded h-100 shadow-sm help-card"
             data-bs-toggle="modal"
             data-bs-target="#helpModal"
             data-help-type="Корм та ліки"
             style="cursor: pointer;">
            <h3>🍖 Корм та ліки</h3>
            <p>Ми завжди потребуємо корм, медикаменти, миски та засоби догляду.</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 border rounded h-100 shadow-sm help-card"
             data-bs-toggle="modal"
             data-bs-target="#helpModal"
             data-help-type="Волонтерство"
             style="cursor: pointer;">
            <h3>🤝 Волонтерство</h3>
            <p>Допомога у догляді, вигулі, прибиранні та соціалізації тварин.</p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 border rounded h-100 shadow-sm help-card""
             data-bs-toggle="modal"
             data-bs-target="#helpModal"
             data-help-type="Інформаційна підтримка"
             style="cursor: pointer;">
            <h3>📢 Інформаційна підтримка</h3>
            <p>Поширюйте інформацію про наших тварин, щоб допомогти їм знайти дім.</p>
        </div>
    </div>

</div>

<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('help_requests.store') }}" novalidate>
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">Заявка на допомогу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрити"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="help_type" id="help_type" value="{{ old('help_type') }}">

                    <div class="mb-3">
                        <label class="form-label">Тип допомоги</label>
                        <input type="text"
                               id="help_type_visible"
                               class="form-control {{ $errors->has('help_type') ? 'is-invalid' : '' }}"
                               value="{{ old('help_type') }}"
                               readonly>

                        <div class="invalid-feedback">
                            @foreach ($errors->get('help_type') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Ваше ім’я</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                        <div class="invalid-feedback">
                            @foreach ($errors->get('name') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text"
                               name="phone"
                               id="phone"
                               value="{{ old('phone') }}"
                               class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">

                        <div class="invalid-feedback">
                            @foreach ($errors->get('phone') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

                        <div class="invalid-feedback">
                            @foreach ($errors->get('email') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Повідомлення</label>
                        <textarea name="message"
                                  id="message"
                                  rows="4"
                                  class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') }}</textarea>

                        <div class="invalid-feedback">
                            @foreach ($errors->get('message') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Закрити
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Надіслати заявку
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    const helpModal = document.getElementById('helpModal');

    helpModal.addEventListener('show.bs.modal', function (event) {
        const card = event.relatedTarget;
        const helpType = card.getAttribute('data-help-type');

        document.getElementById('help_type').value = helpType;
        document.getElementById('help_type_visible').value = helpType;
    });

    @if($errors->any())
        const modal = new bootstrap.Modal(helpModal);
        modal.show();
    @endif
</script>

<style>

.help-card{
    transition: 0.3s;
}

.help-card:hover{
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    background-color: #f8f9fa;
}

</style>

@endsection