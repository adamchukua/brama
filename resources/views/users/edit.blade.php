@extends('layouts.app')

@section('title', 'Налаштування')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Профіль</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="/user/{{ $user->id }}">Перегляд</a>
                <a class="nav-link active" href="/user/{{ $user->id }}/edit">Налаштування</a>
                <a class="nav-link" type="/user/{{ $user->id }}/reviews">Відгуки</a>
            </div>
        </div>

        <div class="col-9">
            <h1 class="fw-bolder mb-3">Налаштування</h1>

            <form action="/user/{{ $user->id }}/update" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Ім'я</label>

                    <input type="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name', $user->name) }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>

                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email', $user->email) }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>

            <h3 class="fw-bold my-3">Видалення аккаунту</h3>

            <p>Цю операцію неможливо відмінити!</p>

            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                Видалити акаунт
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Підтвердження видалення акаунту</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Видалити акаунт?<br>
                <strong>Цю операцію не можна відмінити!</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>

                <form action="/user/{{ $user->id }}/delete" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-primary">Видалити акаунт</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
