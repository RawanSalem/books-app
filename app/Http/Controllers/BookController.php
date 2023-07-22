<?php

namespace App\Http\Controllers;

use App\Filters\BookFilters;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display all books list.
     *
     * @return AnonymousResourceCollection
     */
    public function index(BookSearchRequest $request, BookFilters $filters)
    {
        $books = Book::select(['id', 'name' ,'ISBN', 'publish_date', 'rate', 'pages', 'author_id'])->with([
            'author' => function ($q) {
                return $q->select(['id', 'name']);
        }])->filter($filters)->paginate(20); 

        return BookResource::collection($books);
    }


    /**
     * Show a specified book by id.
     *
     * @param  Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        return new BookResource(
            $book->load(['author' => function ($q) {
                        return $q->select(['id', 'name']);
                    }])
        );
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
     * Update a specified book by id. 
     *
     * @param  UpdateBookRequest  $request
     * @param  Book $book
     * @return BookResource
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return new BookResource($book);
    }

    /**
     * Delete a specified book.
     *
     * @param  Book  $book
     * @return JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return responder()->success()->respond(Response::HTTP_OK);
    }
}
