<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends BaseController
{
    public function toggleFavorite(Book $book)
    {
        $user = Auth::guard('user')->user();

        if ($user->favorites()->where('book_id', $book->id)->exists()) {
            // If the book is already in favorites, remove it
            $user->favorites()->detach($book->id);
        } else {
            // If the book is not in favorites, add it
            $user->favorites()->attach($book->id);
        }

        return redirect()->back();
    }

    public function index(Request $request)
    {
        $user = Auth::guard('user')->user();
        $query = $request->input('keywords'); // Get the search keywords from the request
        
        // Paginate favorite books, showing 6 per page and filter by title if query is provided
        $favoriteBooks = $user->favorites()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
            ->paginate(6);

        return view('Frontend.pages.list.index', compact('favoriteBooks', 'user', 'query'));
    }
}
