@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Создать новую роль</h1>

        @if(auth()->user()->can('create roles'))
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Название роли</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Создать роль</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Назад</a>
            </form>
        @endif
    </div>
@endsection
