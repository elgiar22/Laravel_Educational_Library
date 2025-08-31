@extends('layout')

@section('content')

    @if (session()->has("success"))

    <div class="alert alert-success">{{ session()->get("success") }}</div>
    @endif
    <h1>   <a href="{{ route("allBooks") }}">All Books</a>  </h1>
 
       <h3> bookName : {{$book->title}}</h3>
       <p> bookDesc : {{$book->desc}}</p>
       <p> bookPrice : {{$book->price}}</p>

       categoryname : <a href="{{route('showCategory' , $book->category->id)}}">{{$book->category->name}}</a> 
       <br>
       <br>
       <img src="{{ asset("storage/$book->image") }}" alt="" width="150">
       <hr>
        <a href="{{ route('editBook' , $book->id) }}" class="btn btn-info">Edit</a>
   
   <form action="{{route('deleteBook' , $book->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>



@endsection