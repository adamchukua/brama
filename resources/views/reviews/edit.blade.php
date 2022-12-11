@extends('layouts.app')

@section('title', 'Налаштування')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Профіль</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="/user/{{ $review->user->id }}">Перегляд</a>
                <a class="nav-link" href="/user/{{ $review->user->id }}/edit">Налаштування</a>
                <a class="nav-link" href="/user/{{ $review->user->id }}/reviews">Відгуки</a>
            </div>
        </div>

        <div class="col-9">
            <h1 class="fw-bolder mb-3">Зміна відгуку про {{ $review->good->title }}</h1>

            <form action="/review/{{ $review->id }}/update" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="text" class="form-label">Текст</label>

                    <textarea class="form-control @error('text') is-invalid @enderror"
                           id="text"
                           name="text">{{ old('text', $review->text) }}</textarea>

                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
        </div>
    </div>
</div>
@endsection
