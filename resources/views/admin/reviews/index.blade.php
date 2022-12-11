@extends('layouts.app')

@section('title', 'Адмін-панель')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Адмін-панель</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="/admin">Товари</a>
                <a class="nav-link active" href="/reviews">Відгуки</a>
                <a class="nav-link" href="/good/create">Додати товар</a>
            </div>
        </div>

        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <div>
                    <h1 class="fw-bold">Всі відгуки</h1>

                    <p class="text-muted">Кількість: {{ $reviews->count() }}</p>
                </div>
            </div>

            @if($reviews->first())
                <table class="table">
                    <tr>
                        <th>id</th>
                        <th>Товар</th>
                        <th>Користувач</th>
                        <th>Текст</th>
                        <th>Написано</th>
                        <th>Оновлено</th>
                        <th>Дії</th>
                    </tr>

                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->good->title }}</td>
                            <td>
                                <a href="/user/{{ $review->user->id }}">
                                    {{ $review->user->name }}
                                </a>
                            </td>
                            <td>{{ $review->text }}</td>
                            <td>{{ $review->created_at }}</td>
                            <td>{{ $review->updated_at }}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteReviewModal{{ $review->id }}">
                                    Видалити
                                </button>
                            </td>

                            <td>
                                <div class="modal fade"
                                     id="deleteReviewModal{{ $review->id }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Підтвердження видалення відгуку</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Видалити відгук на "{{ $review->good->title }}"?<br>
                                                <strong>Цю операцію не можна відмінити!</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>

                                                <form action="/review/{{ $review->id }}/delete" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary" type="submit">Видалити</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>Поки що ніхто не писав відгуки...</p>
            @endif

            <div class="d-flex justify-content-center mt-4">
                {{ $reviews->links() }}
            </div>
         </div>
    </div>
</div>
@endsection
