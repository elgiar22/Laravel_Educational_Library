<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function all(){
        $books = Book::paginate(1);
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
                'price'=>'required|numeric',
                'image' =>'required|image|mimes:png,jpg,jpeg,gif',
                'category_id'=>'required|numeric|exists:categories,id'
            ]);
        //store 
    
            $data['image'] = Storage::putFile("books",$request->image);
            $data['user_id'] = 1;
        
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
                'price'=>'required|numeric',
                'image' =>'image|mimes:png,jpg,jpeg,gif',
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

            $book->update($data);

            session()->flash("success",value: "data updated successfuly");

            return redirect(route('showBook',$id));


    }

    
    public function delete($id){
        $book = Book::findOrFail($id);

        Storage::delete($book->image);

        $book->delete();


        session()->flash("success",value: "data deleted successfuly");
        
        return redirect(route('allBooks'));
    
    }
}
