@extends('layouts.app')

@section('title', 'Всі товари')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Фільтри</h2>

            <p class="fw-bold">Категорія</p>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach(\App\Models\Section::all() as $section)
                    @if($section->subsection_id == null)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed px-1"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $section->id }}"
                                        aria-expanded="false"
                                        aria-controls="flush-collapse{{ $section->id }}">
                                    {{ $section->title }}
                                </button>
                            </h2>

                            <div id="flush-collapse{{ $section->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $section->id }}">
                                <div class="accordion-body">
                                    <ul class="list-unstyled">
                                        @foreach(\App\Models\Section::where('subsection_id', $section->id)->get() as $subsection)
                                            <li>
                                                <a href="/goods?section={{ $subsection->id }}"
                                                   class="text-decoration-none {{ $subsection->id == app('request')->input('section') ? 'fw-bold' : '' }}">
                                                    {{ $subsection->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="filters">
                <div class="filter-item">
                    <p class="fw-bold">Продавець</p>

                    <form action="" method="get">
                        <div class="form-check">
                            <label class="form-check-label" for="seller_brama">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="seller_brama"
                                       onclick="redirect()" {{ app('request')->input('seller') == 'brama' ? 'checked' : '' }}>Brama
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox" onclick="redirect()" id="seller_other"{{ app('request')->input('seller') == 'other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="seller_other">Інші</label>
                        </div>
                    </form>
                </div>

                <!--
                <div class="filter-item mt-3">
                    <p class="fw-bold">Ціна</p>

                    <form action="" class="d-flex align-items-baseline">
                        <input type="number" class="form-control">

                        <p class="mx-2">–</p>

                        <input type="number" class="form-control">

                        <button class="btn btn-secondary ms-2">ОК</button>
                    </form>
                </div>
                -->
            </div>
        </div>

        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <div>
                    @if(app('request')->input('search'))
                        <h1 class="fw-bold">Результат пошуку: {{ app('request')->input('search') }}</h1>
                    @elseif(app('request')->input('section'))
                        <h1 class="fw-bold">
                            {{ \App\Models\Section::where('id', '=', app('request')->input('section'))->first()->title }}
                        </h1>
                    @else
                        <h1 class="fw-bold">Всі товари</h1>
                    @endif

                    <p class="text-muted">Кількість: {{ $goods_count }}</p>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Сортувати:
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                           href="/goods?sort=-price{{ request()->section ? '&section=' . request()->section : '' }}">
                            ↑ ціна
                        </a>

                        <a class="dropdown-item"
                           href="/goods?sort=price{{ request()->section ? '&section=' . request()->section : '' }}">
                            ↓ ціна
                        </a>

                        <a class="dropdown-item"
                           href="/goods?sort=-pop{{ request()->section ? '&section=' . request()->section : '' }}">
                            ↑ популярність
                        </a>

                        <a class="dropdown-item"
                           href="/goods?sort=pop{{ request()->section ? '&section=' . request()->section : '' }}">
                            ↓ популярність
                        </a>
                    </div>
                </div>
            </div>

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

            <div class="d-flex justify-content-center mt-4">
                {{ $goods->links() }}
            </div>
         </div>
    </div>
</div>

<script>
    function redirect()
    {
        if(document.getElementById('seller_brama').checked === true)
            window.location.href = '/goods?seller=brama&{{ $request_all }}';
        else if(document.getElementById('seller_other').checked === true)
            window.location.href = '/goods?seller=other&{{ $request_all }}';
    }
</script>
@endsection
