@extends('layout.master')

@section('content')
<div class="container">
    
    <div class="alert alert-danger" role="alert">
    @if($errore->any())
      @foreach($errors->all() as $error)
      <ul class="list-group">
          <li class="list-group-item">{{$error}}</li>
      </ul>
      @endforeach
    @endif
    </div>

    <div class="card">
        <h2>Create Item</h2>
        <form method="post" >
          @csrf
            <div class="form-group">
              <label >Items Name</label>
              <input type="text" class="form-control"  name="item" >
            </div>
            <div class="form-group">
              <label >Description</label>
              <input type="text" class="form-control" name="description" >
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>cmd
          </form>
    </div>
</div>

@endsection