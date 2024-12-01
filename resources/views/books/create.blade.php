@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>Внесите данные вашей книги</h4>
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('create books'))
            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Автор</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="mb-3">
                    <label for="page_count" class="form-label">Кол-во страниц</label>
                    <input type="text" class="form-control" id="page_count" name="page_count" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Статус доступности</label>
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Категория</label>
                    <input type="text" class="form-control" id="category_id" name="category_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </form>
        @else
            <p>У вас нет прав на создание книг.</p>
        @endif
    </div>
@endsection
