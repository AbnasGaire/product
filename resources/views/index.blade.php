@extends('layout.master')

@section('content')
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-secondary" role="alert">
        {{session()->get('success')}}
      </div>
    @endif


    @if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{session()->get('error')}}
      </div>
    @endif

    @if(session()->has('update'))
    <div class="alert alert-primary" role="alert">
        {{session()->get('update')}}
      </div>
    @endif
    <table class='table'>
        <tr>
            <th>Item</th>
            <th>Description</th>
        </tr>
       
        @foreach($items as $item)
        <tr>
            <td><a href="/item/{{$item->id}}">{{$item->item}}</a></td>
            <td>{{$item->description}}</td>
        </tr>
        @endforeach
        
    

       
    </table>
     @if(count($items)>0)
        <ul class="pagination " style="margin-left:45%">
            {{$items->links()}}
        </ul>
    @endif
</div>
@endsection