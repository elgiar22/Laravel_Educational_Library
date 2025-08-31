@extends('layout')

@section('content')

{{-- @if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach --}}
{{-- @endif --}}
    <h1>Edit Category</h1>
    <form action="{{ route('updateCategory',$category->id)}}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $category->name }}">
        <br>
        @error('name')
            {{$message}}
        @enderror
        <br>        
        <label for="description">Description:</label>       
        <textarea name="desc" id="">{{ $category->desc }}</textarea>
        <br>
        @error('desc')
            {{$message}}
        @enderror
        <br>        
        <img src="{{ asset("storage/$category->image") }}" alt="" width="150" >
        <input type="file" name="image">
                <br>
        @error('image')
            {{$message}}
        @enderror
        <br>
        <button type="submit" class="btn btn-info">Update</button>
    </form>
@endsection