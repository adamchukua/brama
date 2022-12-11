@extends('layouts.app')

@section('title', 'Адмін-панель')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Адмін-панель</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" href="/admin">Товари</a>
                <a class="nav-link" href="/reviews">Відгуки</a>
                <a class="nav-link" href="/good/create">Додати товар</a>
            </div>
        </div>

        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <div>
                    @if(app('request')->input('search'))
                        <h1 class="fw-bold">Результат пошуку: {{ app('request')->input('search') }}</h1>
                    @elseif(app('request')->input('section'))
                        <h1 class="fw-bold">
                            {{ \App\Models\Section::where('id', '=', app('request')->input('section')) }}
                        </h1>
                    @else
                        <h1 class="fw-bold">Всі товари</h1>
                    @endif

                    <p class="text-muted">Кількість: {{ $goods->count() }}</p>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Сортувати:
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                           href="/search?sort=time{{ request()->type ? '&type=' . request()->type : '' }}">
                            ↑ ціна
                        </a>

                        <a class="dropdown-item"
                           href="/search?sort=time{{ request()->type ? '&type=' . request()->type : '' }}">
                            ↓ ціна
                        </a>

                        <a class="dropdown-item"
                           href="/search?sort=time{{ request()->type ? '&type=' . request()->type : '' }}">
                            ↑ популярність
                        </a>

                        <a class="dropdown-item"
                           href="/search?sort=time{{ request()->type ? '&type=' . request()->type : '' }}">
                            ↓ популярність
                        </a>
                    </div>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>id</th>
                    <th>Назва</th>
                    <th>Кількість</th>
                    <th>Створено</th>
                    <th>Оновлено</th>
                    <th>Дії</th>
                </tr>

                @foreach($goods as $good)
                    <tr>
                        <td>{{ $good->id }}</td>
                        <td>{{ $good->title }}</td>
                        <td>{{ $good->quantity }}</td>
                        <td>{{ $good->created_at }}</td>
                        <td>{{ $good->updated_at }}</td>
                        <td>
                            <a href="/good/{{ $good->id }}/edit"
                               class="btn btn-secondary mb-2">
                                Змінити
                            </a>

                            <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteGoodModal{{ $good->id }}">
                                Видалити
                            </button>
                        </td>

                        <td>
                            <div class="modal fade"
                                 id="deleteGoodModal{{ $good->id }}"
                                 tabindex="-1"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Підтвердження видалення товару</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Видалити "{{ $good->title }}"?<br>
                                            <strong>Цю операцію не можна відмінити!</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відмінити</button>

                                            <form action="/good/{{ $good->id }}/delete" method="post">
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
         </div>
    </div>
</div>
@endsection
