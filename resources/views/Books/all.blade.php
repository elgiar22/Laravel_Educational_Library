@extends('layout')

@section('title')
all Books
@endsection

@section('css')
<style>
    
</style>
@endsection

@section('content')


    @if (session()->has("success"))

    <div class="alert alert-success">{{ session()->get("success") }}</div>

    @endif

    <h2><a href="Books/create">Create new Book</a></h2>

   @foreach ($books as $book)

   <h1>{{ $loop->iteration }} - <a href={{ route("showBook",$book->id )}}>{{$book->title}}</a> </h1>
    <p>{{$book->desc}}</p>
    <img src="{{ asset("storage/$book->image") }}" alt="" width="150">

       <hr>
   @endforeach


        {{ $books->links() }}
@endsection
