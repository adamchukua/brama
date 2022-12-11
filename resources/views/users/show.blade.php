@extends('layouts.app')

@section('title', 'Профіль')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Профіль</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" href="/user/{{ $user->id }}">Перегляд</a>
                <a class="nav-link" href="/user/{{ $user->id }}/edit">Налаштування</a>
                <a class="nav-link" href="/user/{{ $user->id }}/reviews">Відгуки</a>
            </div>
        </div>

        <div class="col-9">
            <h1 class="fw-bolder mb-3">{{ $user->name }}</h1>

            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Зареєстрований:</strong> @dateonly($user->created_at)</p>
            <p><strong>Кількість відгуків:</strong> {{ $user->reviews->count() }}</p>
        </div>
    </div>
</div>
@endsection
