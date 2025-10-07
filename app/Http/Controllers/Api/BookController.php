<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|digits:4|integer|min:1500|max:' . date('Y'),
        ]);
         $book = Book::create($validated);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json($book, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'nullable|digits:4|integer|min:1500|max:' . date('Y'),
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    
    }
}
