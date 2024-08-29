<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends BaseController
{
    public function index(Request $request)
    {
        $user = Auth::guard('user')->user(); // Gunakan custom guard untuk mendapatkan pengguna yang terautentikasi
        $categories = Category::all(); // Ambil semua kategori

        // Ambil kata kunci pencarian dari permintaan
        $keywords = $request->input('keywords');

        // Bangun query dengan paginasi dan logika pencarian
        $books = Book::with('category')
            ->when($keywords, function ($queryBuilder) use ($keywords) {
                return $queryBuilder->where('title', 'like', '%' . $keywords . '%');
            })
            ->paginate(5);

        return view('Frontend.pages.book.index', compact('books', 'categories', 'user', 'keywords'));
    }


    public function filterByCategory(Request $request)
    {
        $user = Auth::guard('user')->user(); // Use the custom guard to get the authenticated user

        $categoryId = $request->input('category');

        $query = Book::query();

        if ($categoryId) {
            $query->where('categories_id', $categoryId);
        }

        $books = $query->paginate(5); // Fetch filtered books with pagination
        $categories = Category::all();

        return view('Frontend.pages.book.index', compact('books', 'user', 'categories'));
    }

    public function show(Request $request, $id)
    {
        $categoryId = $request->input('category');

        $query = Book::query();

        if ($categoryId) {
            $query->where('categories_id', $categoryId);
        }

        $books = $query->paginate(5); // Fetch filtered books with pagination
        $categories = Category::all();

        $book = Book::findOrFail($id);
        return view('Frontend.pages.book.show', compact('book', 'categories'));
    }
}
