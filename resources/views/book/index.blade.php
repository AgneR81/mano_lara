



@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Knygos</div>

               <div class="card-body">
               <table class="table">
                      <tr>
                        <th>Cover</th> 
                        <th>Title</th>
                        <th>Author</th>
                        <th>edit</th>
                        <th>delete</th>
                      </tr>
                    
                          @foreach ($books as $book)

                            <tr>
                              <td>
                                @if ($book->photo !=null)
                                <img src="{{asset('booksFiles/big/'.$book->photo)}}" alt="nera foto" width="50" heigth="50" >
                                  <form action="{{route('book.deletePhoto',[$book])}}" method="post">
                                    @csrf
                                    <button type="submit">trinti</button>
                                  </form>
                                  <form action="{{route('book.updatePhoto',[$book])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="photo">
                                    <button type="submit">atnaujinti</button>
                                  </form>
                                  @else
                                  <p>ikelkite nuotrauka</p>
                                @endif
                              </td>
                            
                                <td>{{$book->title}}</td>
                                <td>{{$book->author->name}}{{$book->author->surname}}</td>
                            
                                <td>
                                  <a class="btn btn-success" href="{{route('book.edit',[$book])}}">EDIT</a>
                                </td>
                                <td>
                                  @if(Auth::user())

                                  <form method="POST" action="{{route('book.destroy', $book)}}">
                                  @csrf
                                  <button class="btn btn-danger" type="submit">DELETE</button>
                                  </form>
                                  </td>       
                                @endif
                            </tr>

                    <br>
                  @endforeach
                 </table>        
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
