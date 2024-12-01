<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        if (auth()->user()->can('edit books', $user)) {
        return view('users.edit', compact('user', 'roles'));
        } else {
            return redirect()->route('users.index')->with('error', 'У вас нет прав для редактирования роли пользователя.');
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->can('edit books')) {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'Роль успешно назначена!');
        } else {
            return redirect()->route('users.index')->with('error', 'У вас нет прав для редактирования роли пользователя.');
        }
    }

    public function destroy(User $user)
    {
        if (auth()->user()->can('delete users', $user)) {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Пользователь удален успешно!');
        } else {
            return redirect()->route('users.index')->with('error', 'Вы не можете удалить пользователя.');
        }
    }
}
