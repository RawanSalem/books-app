<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display all books list.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $books = Book::select(['id', 'name' ,'ISBN', 'publish_date', 'rate', 'pages', 'author_id'])->with([
            'author' => function ($q) {
                return $q->select(['id', 'name']);
        }])->paginate(5); 

        return BookResource::collection($books);
    }


    /**
     * Show a specified book by id.
     *
     * @param  $id
     * @return BookResource
     */
    public function show($id)
    {
        $book = Book::select(['id', 'name', 'ISBN', 'publish_date', 'rate', 'pages', 'author_id'])->with([
            'author' => function ($q) {
                return $q->select(['id', 'name']);
            }
        ])->where('id', $id)->get();

        return new BookResource($book);
    }


    /**
     * Store a newly created book.
     *
     * @param  StoreBookRequest  $request
     * @return BookResource
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        $book->refresh();
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
