@extends('layouts.app')

@section('title', $good->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Товар</h2>

            <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4">
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#main">Головне</a>
                    @if($good->description != null)
                        <a class="nav-link" href="#desc">Опис</a>
                    @endif
                    @if($good->characteristics->first() != null)
                        <a class="nav-link" href="#chars">Характеристики</a>
                    @endif
                    <a class="nav-link" href="#reviews">Відгуки</a>
                </nav>
            </nav>
        </div>

        <div class="col-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Головна</a>
                    </li>

                    @php
                        $section = \App\Models\Section::where('id', $good->section->subsection_id)->first()
                    @endphp

                    @while($section != null)
                        <li class="breadcrumb-item">
                            <a href="#">{{ $section->title }}</a>
                        </li>

                        @php
                            $section = \App\Models\Section::where('id', $section->subsection_id)->first()
                        @endphp
                    @endwhile

                    <li class="breadcrumb-item">
                        <a href="#">{{ $good->section->title }}</a>
                    </li>

                    <li class="breadcrumb-item active">{{ $good->title }}</li>
                </ol>
            </nav>

            <div data-bs-spy="scroll" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">

                <div class="row" id="main">
                    <div class="col-8">
                        <img src="/storage/{{ $good->images->first()->path ?? '' }}" alt="{{ $good->title }}" class="w-100">
                    </div>

                    <div class="col-4">
                        <h1>{{ $good->title }}</h1>

                        <p>Продавець: {{ $good->seller->title }}</p>

                        <p><strong>@hryvnias($good->price)</strong></p>

                        @if($good->quantity > 0)
                            <button class="btn btn-primary">Купити</button>
                        @else
                            <p class="text-muted">Немає в наявності</p>
                        @endif
                    </div>
                </div>

                <div id="desc">
                    @if($good->description != null)
                        <h2>Опис</h2>

                        <p>{{ $good->description }}</p>
                    @endif
                </div>

                <div id="chars">
                    @if($good->characteristics->first() != null)
                        <h2>Характеристики</h2>

                        <table class="table">
                            @foreach($good->characteristics as $characteristic)
                                <tr>
                                    <td>{{ $characteristic->title }}</td>
                                    <td>{{ $characteristic->value }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>

                <div id="reviews">
                    <h2>Відгуки</h2>

                    @guest
                        <p class="text-muted">Аби написати відгук Ви повинні <a href="{{ route("login") }}">увійти</a> в акаунт,
                            або <a href="{{ route("register") }}">зареєструватись</a>.</p>
                    @endguest
                    @auth
                        <form action="/good/{{ $good->id }}/review/store" method="post">
                            @csrf

                            <div class="input-group mb-3">
                                <input type="text"
                                       class="form-control @error('text') is-invalid @enderror"
                                       placeholder="Напишіть ваш відгук" name="text">
                                <button class="btn btn-outline-secondary" type="submit">Віправити</button>

                                @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </form>
                    @endif

                    <table class="table">
                        @foreach($good->reviews as $review)
                            <tr>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ $review->text }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
