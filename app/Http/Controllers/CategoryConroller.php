<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryConroller extends Controller
{
   
    public function show(){

        $cats=Category::paginate(4);
       
        return view('category.CategoryPage' , compact('cats'));
    }
    
    public function store(Request $request)
    {
        $request->validate(['cat_name' => 'required|string|unique:categories|min:3|max:40',]);
    
        Category::insert([
            'cat_name' => $request->cat_name ,
            'created_at'=>Carbon::now()
         ]);
              
        return back()->with('message', 'A new category has been added!');
    }
    
    
    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->route('cat.show')->with('message', 'Deleted successfully!');
    }
    
    
    public function update(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|unique:categories|min:3|max:40',
    
        ]);
    
        $id=$request->id;
        Category::findOrFail($id)->update([
            'cat_name' => $request->cat_name,
        ]);
        return redirect()->route('cat.show')->with('message', 'Edited successfully!');
    // end else
    }
}
