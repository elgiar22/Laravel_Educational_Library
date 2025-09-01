<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function all(){
        $books = Book::paginate(3);
        return view("Books.all",compact("books"));
    }   

    public function show($id){
        $book = Book::findOrFail($id);
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
                'file_path' => 'required|file|mimes:pdf|max:100240',
                'category_id'=>'required|numeric|exists:categories,id'
            ]);
        //store 
    
            $data['image'] = Storage::putFile("books",$request->image);
            $data['file_path'] = Storage::putFile("files",$request->file_path);

            $data['user_id'] = 1; //ererrr
            // $data['user_id'] = auth()->id();
            Book::create($data);
            session()->flash("success","data inserted successfuly");
            //redirect all
            return redirect(route('allBooks'));

    }

        public function edit($id){
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view ("books.edit",compact("book" , "categories"));
        
    }

     public function update($id , Request $request){
            //validation
            $data = $request->validate([
                'title'=>'required|string|max:200',
                'desc'=>'required|string',
                'image' =>'image|mimes:png,jpg,jpeg,gif',
                'file_path' => 'file|mimes:pdf|max:100240',
                'category_id'=>'required|numeric|exists:categories,id'
            ]);

            //check and update
            $book = Book::findOrFail($id);

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

            session()->flash("success",value: "data updated successfuly");

            return redirect(route('showBook',$id));


    }

    
    public function delete($id){
        $book = Book::findOrFail($id);
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

}
