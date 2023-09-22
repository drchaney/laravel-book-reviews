<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __constructor()
    {
        $this->middleware('throttle:reviews')->only(['store']);
        dd($this);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'review' => 'required|min:1',
            'rating' => 'required|min:1|max:5|integer'
        ]);

        $book->reviews()->create($data);

        return redirect()->route('books.show', $book);
    }
}
