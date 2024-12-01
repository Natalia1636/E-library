<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query()->when($request->filled('category'), function ($query) use ($request) {
            $query->where('category_id', $request->input('category'));
        })->where(['status' => 'available'])->get();
        $categories = Category::all();
        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        if (auth()->user()->can('create books')) {
            return view('books.create');
        } else {
            return redirect()->route('books.index')->with('error', 'У вас нет прав для создания новой книги.');
        }
    }

    public function store(BookStoreRequest $request): RedirectResponse
    {
        if (auth()->user()->can('create books', Book::class)) {
            $validatedData = $request->validated();
            $book = new Book();
            $book->fill($validatedData);
            $book->save();
            return redirect()->route('books.index')->with('success', 'Книга добавлена успешно!');
        }
        return redirect()->route('books.index')->with('error', 'У вас нет прав на создание книг.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        if (auth()->user()->can('edit books', $book)) {
            return view('books.edit', compact('book'));
        } else {
            return redirect()->route('books.index')->with('error', 'У вас нет прав для редактирования этой книги.');
        }
    }

    public function update(BookUpdateRequest $request, $id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $user = auth()->user();
        if ($user->can('edit books')) {
            $validatedData = $request->validated();
            $book->update($validatedData);
            return redirect()->route('books.index')->with('success', 'Книга изменена успешно!');
        }
        return redirect()->route('books.index')->with('error', 'У вас нет прав на редактирование книг.');
    }

    public function destroy($id): RedirectResponse
    {
        $book = Book::find($id);
        if (auth()->user()->can('delete books', $book)) {
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Книга удалена успешно!');
        }
        return redirect()->route('books.index')->with('error', 'У вас нет прав на удаление книг.');
    }
}
