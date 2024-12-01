<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleUpdateRequest;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        if (auth()->user()->can('edit roles', $role)) {
            return view('roles.edit', compact('role'));
        } else {
            return redirect()->route('roles.index')->with('error', 'У вас нет прав для редактирования этой роли.');
        }
    }

    public function update(RoleUpdateRequest $request, $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        if (auth()->user()->can('edit roles', $role)) {
            $validatedData = $request->validated();
            $role->update($validatedData);
            return redirect()->route('roles.index')->with('success', 'Роль изменена успешно!');
        }
        return redirect()->route('roles.index')->with('error', 'У вас нет прав на редактирование роли.');
    }

    public function create()
    {
        if (auth()->user()->can('create roles')) {
            return view('roles.create');
        } else {
            return redirect()->route('roles.index')->with('error', 'У вас нет прав для создания новой роли.');
        }
    }

    public function store(StoreRoleRequest $request)
    {
        if (auth()->user()->can('create roles', Role::class)) {
            $validatedData = $request->validated();
            $role = new Role();
            $role->fill($validatedData);
            $role->save();
            return redirect()->route('roles.index')->with('success', 'Роль создана успешно!');
        }
        return redirect()->route('roles.index')->with('error', 'У вас нет прав для создания новой роли.');
    }

    public function destroy($id): RedirectResponse
    {
        $role = Role::find($id);
        if (auth()->user()->can('delete roles', $role)) {
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Роль удалена успешно!');
        }
        return redirect()->route('roles.index')->with('error', 'У вас нет прав на удаление роли.');
    }
}
