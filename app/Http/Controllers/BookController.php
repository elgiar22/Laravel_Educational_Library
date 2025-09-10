<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{

    // 


    public function all(){
        $books = Book::paginate(3);
        return view("Books.all",compact("books"));
    }

    public function search(Request $request){
        $query = $request->get('q', '');
        $category_id = $request->get('category', '');
        $sort = $request->get('sort', 'newest');
        
        // If no search query, redirect to home
        if (empty($query)) {
            return redirect()->route('home');
        }
        
        // Get all categories for filter dropdown
        $categories = Category::all();
        
        // Build the search query
        $booksQuery = Book::with(['category', 'user']);
        
        // Apply search filter - search in title, description, and author name
        $booksQuery->where(function($q) use ($query) {
            $q->where('title', 'LIKE', '%' . addslashes($query) . '%')
              ->orWhere('desc', 'LIKE', '%' . addslashes($query) . '%')
              ->orWhereHas('user', function($userQuery) use ($query) {
                  $userQuery->where('name', 'LIKE', '%' . addslashes($query) . '%');
              });
        });
        
        // Apply category filter if selected
        if (!empty($category_id)) {
            $booksQuery->where('category_id', $category_id);
        }
        
        // Apply sorting
        switch($sort) {
            case 'oldest':
                $booksQuery->orderBy('created_at', 'asc');
                break;
            case 'title':
                $booksQuery->orderBy('title', 'asc');
                break;
            case 'newest':
            default:
                $booksQuery->orderBy('created_at', 'desc');
                break;
        }
        
        // Get paginated results
        $books = $booksQuery->paginate(6)->appends($request->all());
        
        // Logging
        Log::info('Book search performed', [
            'query' => $query,
            'category_id' => $category_id,
            'sort' => $sort,
            'results_count' => $books->count(),
            'ip' => request()->ip()
        ]);
        
        // Return view with all required variables
        return view('search', [
            'books' => $books,
            'query' => $query,
            'categories' => $categories,
            'category_id' => $category_id,
            'sort' => $sort
        ]);
    }

    public function show($id){
        $book = Book::findOrFail($id);
        
        Log::info('Book viewed', [
            'book_id' => $book->id,
            'book_title' => $book->title,
            'user_id' => Auth::id(),
            'ip' => request()->ip()
        ]);
        
        return view("Books.show",compact("book"));
    }

    public function create(){
        $categories = Category::all();
        return view("Books.create",compact('categories'));
    }


    public function store(Request $request){
        //validation
            $data = $request->validate([
                'title'=>'required|string|max:200',
                'desc'=>'required|string',
                'image' =>'required|image|mimes:png,jpg,jpeg,gif',
                'file_path' => 'required|file|mimes:pdf|max:10240', // Reduced from 100MB to 10MB
                'category_id'=>'required|numeric|exists:categories,id'
            ]);
        //store 
    
            $data['image'] = Storage::putFile("books",$request->image);
            $data['file_path'] = Storage::putFile("files",$request->file_path);

    
            $data['user_id'] = Auth::id();
            $book = Book::create($data);
            //logging
            Log::info('Book created', [
                'book_id' => $book->id,
                'book_title' => $book->title,
                'user_id' => Auth::id(),
                'category_id' => $book->category_id,
                'ip' => request()->ip()
            ]);
            
            session()->flash("success","data inserted successfuly");
            //redirect all
            return redirect(route('allBooks'));

    }

        public function edit($id){
        $book = Book::findOrFail($id);
        
        // Check if user can edit this book
        if (!Auth::user()->canEditBook($book)) { // Author only can edit 
            Log::warning('Unauthorized book edit attempt', [
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'book_owner_id' => $book->user_id,
                'ip' => request()->ip()
            ]);
            abort(403, 'Unauthorized action. You can only edit your own books.');
        }
        
        $categories = Category::all();
        return view ("books.edit",compact("book" , "categories"));
    }

     public function update($id , Request $request){
            //validation
            $data = $request->validate([
                'title'=>'required|string|max:200',
                'desc'=>'required|string',
                'image' =>'image|mimes:png,jpg,jpeg,gif',
                'file_path' => 'file|mimes:pdf|max:10240', // Reduced from 100MB to 10MB
                'category_id'=>'required|numeric|exists:categories,id'
            ]);

            //check and update
            $book = Book::findOrFail($id);

            // Check if user can edit this book
            if (!auth()->user()->canEditBook($book)) {
                Log::warning('Unauthorized book update attempt', [
                    'user_id' => Auth::id(),
                    'book_id' => $book->id,
                    'book_owner_id' => $book->user_id,
                    'ip' => request()->ip()
                ]);
                abort(403, 'Unauthorized action. You can only edit your own books.');
            }

            if($request->has('image')){
                //delete old image
                Storage::delete($book->image);
                //upload new image
                $data['image'] = Storage::putFile("books",$request->image);        
            }else{
                $data['image'] = $book->image;
            }

            if($request->has('file_path')){
            //delete old file
             Storage::delete($book->file_path);
         //upload new file
                $data['file_path'] = Storage::putFile("files",$request->file_path);        
            }else{
                $data['file_path'] = $book->file_path;
            }



            $book->update($data);

            Log::info('Book updated', [
                'book_id' => $book->id,
                'book_title' => $book->title,
                'user_id' => Auth::id(),
                'ip' => request()->ip()
            ]);

            session()->flash("success",value: "data updated successfuly");

            return redirect(route('showBook',$id));


    }

    
    public function delete($id){
        $book = Book::findOrFail($id);
        
        // Check if user can delete this book
        if (!auth()->user()->canDeleteBook($book)) { // Author only can edit 
            Log::warning('Unauthorized book deletion attempt', [
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'book_owner_id' => $book->user_id,
                'ip' => request()->ip()
            ]);
            abort(403, 'Unauthorized action. You can only delete your own books.');
        }
        
        Log::alert('Book deleted', [
            'book_id' => $book->id,
            'book_title' => $book->title,
            'user_id' => Auth::id(),
            'ip' => request()->ip()
        ]);
        
        if ($book->image) {
            Storage::delete($book->image);
        }

        if ($book->file_path) {
            Storage::delete($book->file_path);
        }
        
        $book->delete();

        session()->flash("success",value: "data deleted successfuly");
        
        return redirect(route('allBooks'));
    }

public function download(Book $book)
{
    // Check if user can download books
    if (!auth()->check() || !auth()->user()->canDownloadBooks()) {
        abort(403, 'You must be logged in to download books.');
    }

    // Check if file_path exists
    if (!$book->file_path) {
        abort(404, 'File not found!');
    }

    $filePath = public_path('storage/' . $book->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'File not found!');
    }

    return response()->download($filePath, $book->title . '.pdf');
}

public function read(Book $book)
{
    // Check if user can read books
    if (!auth()->check() || !auth()->user()->canReadBooks()) {
        return redirect()->route('loginForm')->with('error', 'You must be logged in to read books.');
    }

    // Check if file_path exists
    if (!$book->file_path) {
        abort(404, 'File not found!');
    }

    $filePath = public_path('storage/' . $book->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'File not found!');
    }

    return response()->file($filePath);
}

    public function authorBooks()
{
    $user = Auth::user();

    $books = $user->books()->with('category')->latest()->get();

    return view('Books/mybooks', compact('books'));
}

}
