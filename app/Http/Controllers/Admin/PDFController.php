<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $book = Book::all(); // Retrieve all books
    
        $data = [
            'title' => 'Books List',
            'date' => date('m/d/Y'),
            'book' => $book
        ];
    
        $pdf = PDF::loadView('Backend.pages.pdf.generate-pdf', $data);
        return $pdf->download('books-list.pdf');
    }
    
}
