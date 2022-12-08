@extends('layouts.app')

@section('title', 'Головна')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Каталог</h2>

            <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
                @foreach($sections as $section)
                    @if($section->subsection_id == null)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $section->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $section->id }}">
                                    {{ $section->title }}
                                </button>
                            </h2>

                            <div id="flush-collapse{{ $section->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $section->id }}">
                                <div class="accordion-body">
                                    <ul class="list-unstyled">
                                        @foreach(\App\Models\Section::where('subsection_id', $section->id)->get() as $subsection)
                                            <li>
                                                <a href="/goods?section={{ $subsection->id }}" class="text-decoration-none">
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
        </div>

        <div class="col-9">
            <img src="https://htmlcolorcodes.com/assets/images/colors/gray-color-solid-background-1920x1080.png"
                 alt="ad"
                 class="w-100">

            <h1 class="fw-bold my-4">Найпопулярніші товари</h1>

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

            <h1 class="fw-bold my-4">Ви нещодавно переглядали</h1>

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
