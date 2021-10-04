

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurimas</div>

               <div class="card-body">
                  <form method="POST" action="{{route('author.store')}}">
                        <div class="form-group">
                           <label>Vardas</label>
                           <input type="text" name="name"  class="form-control" value="">
                           <small class="form-text text-muted">Name</small>
                        </div>
                        <div class="form-group">
                           <label>Pavarde</label>
                           <input type="text" name="surname"  class="form-control" value="">
                           <small class="form-text text-muted">Surname</small>
                        </div>
                       
                        @csrf  
                     <button class="btn btn-primary" type="submit">ADD</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

