
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Trinti</div>

               <div class="card-body">

                    <table class="table">
                      <tr>
                        <th>name</th>
                        <th>surname</th>
                        <th>edit</th>
                        <th>delete</th>
                      </tr>
                    
                          @foreach ($authors as $author)
                            <tr>
                                <td>{{$author->name}}</td>
                                <td>{{$author->surname}}</td>
                                <td>
                                  <a class="btn btn-success" href="{{route('author.edit',[$author])}}">EDIT</a>
                                </td>
                                <td>
                                  @if(Auth::user())

                                  <form method="POST" action="{{route('author.destroy', $author)}}">
                                  @csrf
                                  <button class="btn btn-danger" type="submit">DELETE</button>
                                  </form>
                                  </td>       
                                @endif
                            </tr>
                      <!-- <br> -->
                    @endforeach
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
