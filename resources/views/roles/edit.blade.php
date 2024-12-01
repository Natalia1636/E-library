@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Редактировать роль: {{ $role->name }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(auth()->user()->can('edit roles', $role))
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Название роли</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                </div>
                <br>

                <button type="submit" class="btn btn-success">Сохранить изменения</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Назад</a>
            </form>
        @endif
    </div>
@endsection
