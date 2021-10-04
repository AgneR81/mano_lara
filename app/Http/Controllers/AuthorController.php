<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use DB;
use Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //grazina visus autorius
        $authors = Author::all();
        //eloquent examples
        // $authors = $authors->where('id','>','4');
        // $authors = Author::where('surname','like',"Tw%")->orderby("name",'desc')->get();
            // $authors = DB::select('select * from authors');
            // $authors = Author::hydrate($authors);
            // dd($authors);
        //rusiuoja pagal abecele
        // $authors = Author::where('id', '>',0)->orderby("name")->get();
        return view('author.index', ['authors' => $authors]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request);  ispausdina i terminala
        
        //tikriname salygas su validator------------------------
        $validator = Validator::make($request->all(),
        [
            'name' => ['required', 'min:3', 'max:64'],
            'surname' => ['required', 'min:3', 'max:64'],
         ],

[
'surname.min' => 'Pavarde per trumpa. turi buti bent 3 simboliai',
'name.required' => 'Privalote ivesti varda'
]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
 //---------------------------------------------------------------



        $author = new Author;
        $author->name = $request->name;
        $author->surname = $request->surname;
        $author->save();
        return redirect()->route('author.index')->with('success_message', 'Sekmingai įrašytas.');
        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $author->name = $request->author_name;
       $author->surname = $request->author_surname;
       $author->save();
       return redirect()->route('author.index')->with('success_message', 'Sėkmingai pakeistas.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if($author->books->count()){
            return redirect()->route('author.index')->with('info_message', 'Trinti negalima, nes turi knygų.');
        }

        $author->delete();
        return redirect()->route('author.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
