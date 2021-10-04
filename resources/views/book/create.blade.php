@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Irasyti</div>
                  <div class="card-body">
                     <form method="POST" action="{{route('book.store')}}" enctype="multipart/form-data">


                        <div class="form-group">
                           <label>Title</label>
                           <input type="text" name="book_title"  class="form-control" value="">
                           <small class="form-text text-muted">Knygos pavadinimas</small>
                        </div>
                        <div class="form-group">
                           <label>ISBN</label>
                           <input type="text" name="book_isbn"  class="form-control" value="">
                           <small class="form-text text-muted">Knygos ISBN</small>
                        </div>
                        <div class="form-group">
                           <label>Puslapiai</label>
                           <input type="number" name="book_pages"  class="form-control" value="">
                           <small class="form-text text-muted">Puslapiu kiekis</small>
                        </div>

                        <!-- <div class="form-group">
                           <label>Apie</label>
                           <textarea name="book_about"></textarea>
                           <small class="form-text text-muted">Knygos aprasymas</small>
                        </div> -->

                        <div class="form-group">
                           <label for="summernote">Apie</label>
                           <textarea name="book_about" class="form-control" id="summernote" rows="3"></textarea>
                           <small class="form-text text-muted">Knygos aprasymas</small>
                        </div>
                        <div class="form-group">
                           <label for="summernote">photo</label>
                           <input type="file" name="photo">
                           <small class="form-text text-muted">Nuotrauka</small>
                        </div>
                         
                        <select name="author_id" class="form-control form-control-lg" >
                           @foreach ($authors as $author)
                              <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                           @endforeach
                        </select>
                     @csrf
                     <br>
                     <button class="btn btn-success" type="submit">ADD</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>

<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection
