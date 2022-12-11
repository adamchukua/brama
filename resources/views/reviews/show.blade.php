@extends('layouts.app')

@section('title', 'Профіль')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Профіль</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="/user/{{ $user->id }}">Перегляд</a>
                <a class="nav-link" href="/user/{{ $user->id }}/edit">Налаштування</a>
                <a class="nav-link active" href="/user/{{ $user->id }}/reviews">Відгуки</a>
            </div>
        </div>

        <div class="col-9">
            <h1 class="fw-bolder mb-3">Ваші відгуки</h1>

            @if($user->reviews->first())
                <table class="table">
                    <tr>
                        <th>Товар</th>
                        <th>Дата</th>
                        <th>Коментар</th>
                        <th>Дії</th>
                    </tr>

                    @foreach($user->reviews as $review)
                        <tr>
                            <td>
                                <a href="/good/{{ $review->good->id }}">
                                    {{ $review->good->title }}
                                </a>
                            </td>
                            <td>{{ $review->created_at }}</td>
                            <td>{{ $review->text }}</td>
                            <td>
                                <a href="/review/{{ $review->id }}/edit"
                                   class="btn btn-secondary mb-2">
                                    Змінити
                                </a>

                                <form action="/review/{{ $review->id }}/delete"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-secondary" type="submit">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>Ви поки що не написали ні одного коментаря...</p>
            @endif
        </div>
    </div>
</div>
@endsection
