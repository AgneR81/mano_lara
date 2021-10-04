
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Atnaujinimas</div>

               <div class="card-body">
                  <form method="POST" action="{{route('author.update',$author)}}">
                  <div class="form-group">
                           <label>Vardas</label>
                           <input type="text" name="author_name"  class="form-control" value="{{$author->name}}">
                           <small class="form-text text-muted">Name</small>
                        </div>
                        <div class="form-group">
                           <label>Pavarde</label>
                           <input type="text" name="author_surname"  class="form-control" value="{{$author->surname}}">
                           <small class="form-text text-muted">Surname</small>
                        </div>
                       
                        @csrf  
                     <button class="btn btn-primary" type="submit">EDIT</button>

                     <!-- Name: <input type="text" name="author_name" value="{{$author->name}}">
                     Surname: <input type="text" name="author_surname" value="{{$author->surname}}">
                     @csrf
                     <button type="submit">EDIT</button> -->
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
