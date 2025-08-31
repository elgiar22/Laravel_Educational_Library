@extends('layout')

@section('content')

{{-- @if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif --}}

    <h1>Edit Book</h1>
    <form action="{{ route('updateBook',$book->id)}}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $book->title }}">
        <br>
        @error('title')
            {{$message}}
        @enderror
        <br>
        <label for="description">Description:</label>       
        <textarea name="desc" id="">{{ $book->desc }}</textarea>
        <br>
        @error('desc')
            {{$message}}
        @enderror
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="{{ $book->price }}">
        <br>
        @error('price')
            {{$message}}
        @enderror
        <br>

        <select name="category_id" id="">
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <br>
            @error('category_id')
            {{$message}}
            @enderror
        <br> 
        <img src="{{ asset("storage/$book->image") }}" alt="" width="150" >
        <input type="file" name="image">
        <button type="submit" class="btn btn-info">Update</button>
    </form>

@endsection