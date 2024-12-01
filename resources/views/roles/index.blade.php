@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Список ролей</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->can('create roles'))
            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Создать новую роль</a>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название роли</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>

                        @if(auth()->user()->can('edit roles', $role))
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        @endif

                        @if(auth()->user()->can('delete roles', $role))
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить эту роль?');">Удалить</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if ($roles->isEmpty())
            <div class="alert alert-warning">Нет доступных ролей.</div>
        @endif
    </div>
@endsection
