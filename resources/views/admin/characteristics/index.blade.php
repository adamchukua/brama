@extends('layouts.app')

@section('title', $good->title . 'Редагування')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Адмін-панель</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="/admin">Товари</a>
                <a class="nav-link" href="/reviews">Відгуки</a>
            </div>
        </div>

        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1 class="fw-bold">Редагування характеристик "{{ $good->title }}"</h1>
            </div>

            <table class="table">
                <tr>
                    <th>id</th>
                    <th>Харакеристика</th>
                    <th>Значення</th>
                    <th>Дії</th>
                </tr>

                @foreach($good->characteristics as $characteristic)
                    <tr>
                        <td>{{ $characteristic->id }}</td>
                        <td>{{ $characteristic->title }}</td>
                        <td>{{ $characteristic->value }}</td>
                        <td>
                            <a href="/good/{{ $good->id }}/characteristic/{{ $characteristic->id }}/edit"
                               class="btn btn-secondary mb-2">
                                Змінити
                            </a>

                            <form action="/characteristic/{{ $characteristic->id }}/delete" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-secondary">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            <form action="/good/{{ $good->id }}/characteristic/store" method="post">
                @csrf

                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror me-3"
                               name="title"
                               placeholder="Назва" required>

                        <input type="text"
                               class="form-control @error('value') is-invalid @enderror"
                               name="value"
                               placeholder="Значення" required>
                    </div>

                    <div>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Додати характеристику</button>
            </form>
         </div>
    </div>
</div>
@endsection
