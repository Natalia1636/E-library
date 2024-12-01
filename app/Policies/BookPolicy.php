<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user, Book $book)
    {
        // Проверяем, является ли пользователь администратором
        return $user->role === 'admin';
    }

    public function edit(User $user, Book $book)
    {
        // Например, только администраторы и автор книги могут редактировать
        return $user->role === 'admin' || $user->id;
    }

    // Метод для проверки прав на создание книги
    public function create(User $user)
    {
        // Например, только администраторы могут создавать книги
        return $user->role === 'admin';
    }
}
