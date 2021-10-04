<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use Intervention\Image\ImageManagerStatic as Image;
use Str;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('book.create');
        $authors = Author::all();
       return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
       
        // dd($request->has('photo'))
      

        $book = new Book;
       $book->store($request);
       return redirect()->route('book.index')->with('success_message', 'Sekmingai įrašytas.');
    }



    // public function storePhoto(Request $request) 
    // {

    // }
    public function deletePhoto(Book $book){
        $book->deletePhoto();
        return redirect()->route('book.index')->with('success_message', 'Nuotrauka sekmingai istrinta.');
    }


    public function updatePhoto(Request $request, Book $book){
//delete
//update
       $book->updatePhoto($request);
        return redirect()->route('book.index')->with('success_message', 'Nuotrauka sekmingai pakeista.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors])->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
       $book->updateBook($request);
       return redirect()->route('book.index')->with('success_message', 'Sekmingai atnaujintas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->deleteBook();
        return redirect()->route('book.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
