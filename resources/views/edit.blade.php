@extends('layout.master')

@section('content')
<div class="container">
   
    <div class="card">
        <h2>Edit Item</h2>
        <form method="post" action='/item/{{$item->id}}'>
          @csrf
            <div class="form-group">
              <label >Items Name</label>
              <input type="text" class="form-control"  name="item" value='{{$item->item}}' >
            </div>
            <div class="form-group">
              <label >Description</label>
              <input type="text" class="form-control" name="description"  value='{{$item->description}}'>
            </div>
            <input type='hidden' name='_method' value='put'>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>

@endsection