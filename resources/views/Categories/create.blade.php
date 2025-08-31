@extends('layout')

@section('content')

{{-- @if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif --}}

    <h1>Create Category</h1>
    <form action="{{route("storeCategory")}}" method="POST" enctype="multipart/form-data"> 
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" >
        <br>
        @error('name')
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