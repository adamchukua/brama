@extends('layouts.app')

@section('title', 'Новий товар')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <h2 class="fw-bolder">Адмін-панель</h2>

            <div class="nav flex-column nav-pills me-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" href="/admin">Товари</a>
                <a class="nav-link" href="/reviews">Відгуки</a>
                <a class="nav-link active" href="/good/create">Додати товар</a>
            </div>
        </div>

        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1 class="fw-bold">Додавання нового товару</h1>
            </div>

            <form action="/good/store" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Назва товару</label>

                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title') }}" required>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Опис товару</label>

                    <textarea class="form-control @error('description') is-invalid @enderror"
                           id="description"
                           name="description">{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Вартість (грн)</label>

                        <input type="number" step="0.01" min="0.01"
                           class="form-control @error('price') is-invalid @enderror"
                           id="price"
                           name="price"
                           value="{{ old('price') }}" required>

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Кількість</label>

                    <input type="number" min="1"
                           class="form-control @error('quantity') is-invalid @enderror"
                           id="quantity"
                           name="quantity"
                           value="{{ old('quantity') }}" required>

                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="section" class="form-label">Категорія</label>

                    <select name="section_id" id="section" class="form-select">
                        @foreach(\App\Models\Section::whereNotNull('subsection_id')->get() as $section)
                            <option value="{{ $section->id }}"
                                {{ (old('section_id') == $section->id) ? 'selected' : '' }}>
                                {{ $section->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="seller" class="form-label">Продавець</label>

                    <select name="seller_id" id="seller" class="form-select">
                        @foreach(\App\Models\Seller::all() as $seller)
                            <option value="{{ $seller->id }}"
                                {{ (old('seller_id') == $seller->id) ? 'selected' : '' }}>
                                {{ $seller->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Фотографії товару</label>
                    <input class="form-control" type="file" id="image" name="images[]" multiple required>
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
         </div>
    </div>
</div>
@endsection
