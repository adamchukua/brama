@extends('layouts.app')

@section('title', 'Всі товари')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="filters">
                <div class="filter-item">
                    <p class="fw-bold">Продавець</p>

                    <form action="">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="seller_brama" id="seller_brama">
                            <label class="form-check-label" for="seller_brama">Brama</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="seller_other" id="seller_other">
                            <label class="form-check-label" for="seller_other">Інші</label>
                        </div>
                    </form>
                </div>

                <div class="filter-item mt-3">
                    <p class="fw-bold">Ціна</p>

                    <form action="" class="d-flex align-items-baseline">
                        <input type="number" class="form-control">

                        <p class="mx-2">–</p>

                        <input type="number" class="form-control">

                        <button class="btn btn-secondary ms-2">ОК</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-9">
            <h1>Всі товари</h1>

            <div class="row g-2">
                @foreach($goods as $good)
                    <div class="col-4">
                        <div class="card p-2">
                            <img src="/storage/{{ $good->images->first()->path ?? '' }}"
                                 class="card-img-top" alt="{{ $good->title }}">

                            <div class="card-body">
                                <h5 class="card-title">{{ $good->title }}</h5>
                                <p class="card-text fw-bold">@hryvnias($good->price)</p>
                                <a href="/good/{{ $good->id }}" class="btn btn-primary">Купити</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
         </div>
    </div>
</div>
@endsection
