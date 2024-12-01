@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список пользователей</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роли</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->roles->isEmpty())
                            Нет ролей
                        @else
                            @foreach($user->roles as $role)
                                <h6>{{ $role->name }}</h6>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(auth()->user()->can('edit users', $user))
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Изменить роль</a>
                        @endif
                            @if(auth()->user()->can('delete users', $user))
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить пользователя?');">Удалить</button>
                                </form>
                           @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
