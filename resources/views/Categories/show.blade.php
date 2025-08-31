@extends('layout')

@section('content')

    @if (session()->has("success"))

    <div class="alert alert-success">{{ session()->get("success") }}</div>
    @endif
    <h1>   <a href="{{ url("categories") }}">All categories</a>  </h1>
 
       <h3> CategoryName : {{$category->name}}</h3>
       <p> CategoryDesc : {{$category->desc}}</p>
       <img src="{{ asset("storage/$category->image") }}" alt="" width="150">
       <hr>
   <a href="{{ route('editCategory' , $category->id) }}" class="btn btn-info">Edit</a>
   
   <form action="{{route('deleteCategory' , $category->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>

<hr>
    <h3>Books</h3>
    @foreach ($category->books as $book )
    {{$loop->iteration}} - <a href="{{route('showBook' , $book->id)}}">{{$book->title}}</a> <br>
    @endforeach

@endsection