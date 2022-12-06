@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2>Дані</h2>

            <ul>
                <li>Головне</li>
                <li>Опис</li>
                <li>Характеристики</li>
                <li>Доставка і гарантія</li>
                <li>Відгуки</li>
            </ul>
        </div>

        <div class="col-9">
            <div class="row">
                <div class="col-8">
                    <img src="https://icatcare.org/app/uploads/2018/06/Layer-1704-1920x840.jpg" alt="" class="w-100">
                </div>

                <div class="col-4">
                    <h1>{{ $good->title }}</h1>

                    <p>{{ $good->price }}</p>
                </div>
            </div>

            @if($good->description != null)
                <h2>Опис</h2>

                <p>{{ $good->description }}</p>
            @endif

            <h2>Характеристики</h2>

            <table class="table">
                @foreach($good->characteristics as $characteristic)
                    <tr>
                        <td>{{ $characteristic->title }}</td>
                        <td>{{ $characteristic->value }}</td>
                    </tr>
                @endforeach
            </table>

            <h2>Відгуки</h2>

            @guest
                <p class="text-muted">Аби написати відгук Ви повинні <a href="{{ route("login") }}">увійти</a> в акаунт,
                    або <a href="{{ route("register") }}">зареєструватись</a>.</p>
            @endguest
            @auth
                <form action="/good/{{ $good->id }}/review/store" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Напишіть ваш відгук" name="text">
                        <button class="btn btn-outline-secondary" type="submit">Віправити</button>
                    </div>
                </form>
            @endif

            <table class="table">
                @foreach($good->reviews as $review)
                    <tr>
                        <td>{{ $review->name }}</td>
                        <td>{{ $review->text }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
