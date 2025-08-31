@extends('layout')

@section('content')

{{-- @if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif --}}

    <h1>Create Book</h1>
    <form action="{{route("storeBook")}}" method="POST" enctype="multipart/form-data"> 
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" >
        <br>
        @error('title')
            {{$message}}
        @enderror
        <br>
        <label for="description">Description:</label>  
        <textarea name="desc" id=""></textarea>   
            <br>
        @error('desc')
            {{$message}}
        @enderror
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" >
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
        <br> <br>
        <label for="image">Image:</label>
        <input type="file" name="image" >
        <br>
        @error('image')
            {{$message}}
        @enderror
        
        <br> <br>
        <button type="submit">Create</button>
    </form>

@endsection