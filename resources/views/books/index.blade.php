@extends('layouts.app')
@section('content')
    <body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('books.index') }}>Список доступных книг</a>
            <div class="justify-end ">
                <div class="col">
                    @if(auth()->user()->can('create books'))
                        <a class="btn btn-sm btn-primary" href={{ route('books.create') }}>Добавить книгу</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <br>
    <form action="{{ route('books.index') }}" method="get">
        <div class="mb-3">
            <div class="form-label">Выберите категорию</div>
            <select name="category" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option>Все книги</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline-dark btn-sm">Выбрать</button>
    </form>
    <div class="container mt-5">
        @foreach ($books as $book)
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <h6 class="card-title">{{ $book->author }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $book->description }}</p>
                        <p class="card-text">{{ 'Кол-во страниц: ' . $book->page_count }}</p>
                        <p class="card-text">{{ 'Статус доступности: ' . $book->status }}</p>
                        <p class="card-text">{{ 'Категория: ' . $book->category_id }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                @if(auth()->user()->can('edit books', $book))
                                    <a href="{{ route('books.edit', $book->id) }}"
                                       class="btn btn-outline-primary btn-sm">Редактировать</a>
                                @endif
                            </div>
                            <div class="col-sm">
                                @if(auth()->user()->can('delete books', $book))
                                    <form action="{{ route('books.destroy', $book->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        @endforeach
    </div>
    </div>
    </body>
@endsection
