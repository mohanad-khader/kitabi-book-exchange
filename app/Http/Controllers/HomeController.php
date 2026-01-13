<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Display the home page with featured books
     */
    public function index()
    {
        // الحصول على أحدث الكتب المتاحة
        $latestBooks = Book::available()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        // الحصول على الكتب المجانية
        $freeBooks = Book::available()
            ->free()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // الحصول على الكتب الجامعية
        $universityBooks = Book::available()
            ->byCategory('university')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('home', compact('latestBooks', 'freeBooks', 'universityBooks'));
    }
}