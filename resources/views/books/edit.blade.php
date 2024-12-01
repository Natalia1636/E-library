@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>Внесите новые данные</h4>
        <br>
        @if(auth()->user()->can('edit books', $book))
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{ $book->title }}" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="author">Автор</label>
                    <input type="text" class="form-control" id="author" name="author"
                           value="{{ $book->author }}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="description">Описание книги</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="page_count">Кол-во страниц</label>
                    <input type="text" class="form-control" id="page_count" name="page_count"
                           value="{{ $book->page_count }}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="status">Статус доступности</label>
                    <input type="text" class="form-control" id="status" name="status"
                           value="{{ $book->status }}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <input type="text" class="form-control" id="category_id" name="category_id"
                           value="{{ $book->category_name }}" required>
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </form>
        @else
            <p>У вас нет прав на редактирование этой книги.</p>
        @endif
    </div>
@endsection
