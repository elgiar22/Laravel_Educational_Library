@extends('layout')

@section('title')
all categories
@endsection

@section('css')
<style>
    
</style>
@endsection

@section('content')




    @if (session()->has("success"))

    <div class="alert alert-success">{{ session()->get("success") }}</div>

    @endif

    <h2><a href="categories/create">Create new Category</a></h2>

   @foreach ($categories as $category)

   <h1>{{ $loop->iteration }} - <a href={{ route("showCategory",$category->id )}}>{{$category->name}}</a> </h1>
    <p>{{$category->desc}}</p>
    <img src="{{ asset("storage/$category->image") }}" alt="" width="150">

       <hr>
   @endforeach


        {{ $categories->links() }}
@endsection
