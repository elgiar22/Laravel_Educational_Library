<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //pagination (1 - all , get->paginate() , 2- view $catigories->link() , 3-providers (app -> boot(paginator::use)))

    public function all(){
        //select * from categories
        $categories = Category::withCount('books')->paginate(3);
;
        return view("Categories.all",compact('categories'));
    }

    public function show($id){
        //select * from categories where id=$id
        $category = Category::findOrFail($id);
        return view("Categories.show",compact('category'));

    }

    public function create(){
        return view("Categories.create");
    }

        public function store(Request $request){
        //validation
            $data = $request->validate([
                'name'=>'required|string|max:200',
                'desc'=>'required|string',
                'image' =>'required|image|mimes:png,jpg,jpeg,gif'

            ]);
        //store 
    
            $data['image'] = Storage::putFile("categories",$request->image);        
            Category::create($data);
            session()->flash("success","data inserted successfuly");

            //redirect all
            return redirect(route('allCategories'));

    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view ("Categories.edit",compact("category"));
        
    }

    public function update($id , Request $request){
            //validation
            $data = $request->validate([
                'name'=>'required|string|max:200',
                'desc'=>'required|string',
                'image' => 'image|mimes:png,jpg,jpeg,gif'

            ]);

            //check and update
            $category = Category::findOrFail($id);

            if($request->has('image')){
                //delete old image
                Storage::delete($category->image);
                //upload new image
                $data['image'] = Storage::putFile("categories",$request->image);        
            }else{
                $data['image'] = $category->image;
            }

            $category->update($data);

            session()->flash("success",value: "data updated successfuly");

            return redirect(route('showCategory',$id));


    }

    public function delete($id ){
        //check and delete
        $category = Category::findOrFail($id); 
        
    if ($category->image) {

        Storage::delete($category->image);
    }
        $category->delete();

        session()->flash("success", "data deleted successfuly");
        
        return redirect(route('allCategories'));
        
    }

}

