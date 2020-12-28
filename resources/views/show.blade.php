@extends('layout.master')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{$item->item}}</h1>
            
            <hr class="my-4">
            <p>{{$item->description}}</p>
        
            <a href='/item/{{$item->id}}/edit' class="btn btn-primary">Edit</a>
            
             <form method='post' action='/item/{{$item->id}}' >
                @csrf
                <input type='hidden' name='_method' value='delete'>
                <button  type='submit' class="btn btn-danger">Delete</button>
                
            </form> 
          </div>
    </div>
@endsection