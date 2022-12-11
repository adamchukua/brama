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

            <form action="/characteristic/{{ $characteristic_edit->id }}/update" method="post">
                @csrf
                @method('PATCH')

                <table class="table">
                    <tr>
                        <th>id</th>
                        <th>Харакеристика</th>
                        <th>Значення</th>
                        <th>Дії</th>
                    </tr>

                    @foreach($good->characteristics as $characteristic)
                        <tr>
                            @if($characteristic == $characteristic_edit)
                                <td>
                                    <input type="number"
                                           class="form-control"
                                           name="id"
                                           disabled required value="{{ $characteristic_edit->id }}">
                                </td>

                                <td>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror me-3"
                                           name="title"
                                           value="{{ $characteristic_edit->title }}" required>
                                </td>

                                <td>
                                    <input type="text"
                                           class="form-control @error('value') is-invalid @enderror me-3"
                                           name="value"
                                           value="{{ $characteristic_edit->value }}" required>
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-primary">Зберегти</button>
                                </td>
                            @else
                                <td>{{ $characteristic->id }}</td>
                                <td>{{ $characteristic->title }}</td>
                                <td>{{ $characteristic->value }}</td>
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </form>
         </div>
    </div>
</div>
@endsection
