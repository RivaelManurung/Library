<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Exports\BookExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller as BaseController;

class BookController extends BaseController
{
    public function index(Request $request)
    {
        $query = Book::with('category');
    
        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
        }
    
        $books = $query->paginate(10);
    
        return view('Backend.pages.book.index', compact('books'));
    }
    


    public function create()
    {
        $categories = Category::all(); // Fetch all categories for dropdown
        return view('Backend.pages.book.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'description' => 'required',
            'quantity' => 'required|integer',
            'file_path' => 'nullable|mimes:pdf',
            'cover_path' => 'nullable|mimes:jpeg,jpg,png',
        ]);

        $file_path = null;
        $cover_path = null;

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            if ($file->isValid()) {
                $file_path = 'FT' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $file_path);
            }
        }

        if ($request->hasFile('cover_path')) {
            $cover = $request->file('cover_path');
            if ($cover->isValid()) {
                $cover_path = 'cover_' . date('YmdHis') . '.' . $cover->getClientOriginalExtension();
                $cover->move(public_path('covers'), $cover_path);
            }
        }

        $data = new Book();
        $data->title = $request->title;
        $data->categories_id = $request->categories_id;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->file_path = $file_path;
        $data->cover_path = $cover_path;
        $data->save();

        return redirect()->route('book.index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('Backend.pages.book.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('Backend.pages.book.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'description' => 'required',
            'quantity' => 'required|integer',
            'file_path' => 'nullable|mimes:pdf',
            'cover_path' => 'nullable|mimes:jpeg,jpg,png',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            if ($file->isValid()) {
                $file_path = 'FT' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $file_path);
                $book->file_path = $file_path; // Update file path
            }
        }

        if ($request->hasFile('cover_path')) {
            $cover = $request->file('cover_path');
            if ($cover->isValid()) {
                $cover_path = 'cover_' . date('YmdHis') . '.' . $cover->getClientOriginalExtension();
                $cover->move(public_path('covers'), $cover_path);
                $book->cover_path = $cover_path; // Update cover path
            }
        }

        $book->title = $request->title;
        $book->categories_id = $request->categories_id;
        $book->description = $request->description;
        $book->quantity = $request->quantity;
        $book->save();

        return redirect()->route('book.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Category deleted successfully!');
    }

    public function export()
    {
        // Export the books data to an Excel file with a dynamic filename
        return Excel::download(new BookExport, 'books-' . Carbon::now()->timestamp . '.xlsx');
    }
}
