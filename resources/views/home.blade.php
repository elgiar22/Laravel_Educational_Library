<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #111827;
        }
        h2 {
            margin-top: 40px;
            color: #1f2937;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .section {
            margin-bottom: 30px;
        }
        .show-all {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #2563eb;
            color: white;
            border-radius: 6px;
            transition: 0.3s;
        }
        .show-all:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>
    <h1>Book Management</h1>

    <a href="{{route('loginForm')}}">Login </a>
    <a href="{{route('registerForm')}}">Register </a>
    <div class="section">
        <h2>Books</h2>
        <ul>
            @foreach($books as $book) 
                <li>
                    <a href="{{ route('showBook', $book->id) }}">
                        {{ $book->title }}
                    </a>
                </li>
            @endforeach
        </ul>
        <a class="show-all" href="{{ route('allBooks') }}">Show All Books</a>
    </div>

    <div class="section">
        <h2>Categories</h2>
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('showCategory', $category->id) }}">
                        {{ $category->name }}
                    </a>
                    
                </li>
            @endforeach
        </ul>
        <a class="show-all" href="{{ route('allCategories') }}">Show All Categories</a>
    </div>
</body>
</html>
