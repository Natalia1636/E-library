@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Назначить роль для пользователя: {{ $user->name }}</h3>

        @if(auth()->user()->can('edit users', $user))
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                @endif

                <div class="form-group">
                    <label for="role">Роль</label>
                    <br>
                    <select name="role" id="role" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
    </div>
@endsection
