<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){

        $product = Product::paginate(3);
        return view('product.index',compact('product'));
    }
    
    
    
       
    
    public function create(){
    
        $cats = Category::latest()->get();
        return view('product.create_product' ,compact('cats'));
        
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'description' => 'required|min:3|max:500',
            'price' => 'required|numeric',
            'image' => 'required|mimes:png,jpeg,jpg',
           
        ]);
    
        $image = $request->file('image'); //$image = clinic.jpg
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); 
            //$name_gen =4654654646 .jpg
            Image::make($image)->resize(300, 300)->save('upload/Product/'. $name_gen);
    
            $save_url = 'upload/Product/' . $name_gen;
    
          
            Product::insert([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $save_url,         
            ]);
    
    
            $notification = array(
                'message_id' => 'the product has been added successfully!',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);
    
    
       
    }
    
    
    
    
    public function edit($id){
    
        $product = Product::find($id);
    
        $cats = Category::latest()->get();
    
        return view('product.edit_product' ,compact('product','cats'));
    
    }
    
    public function update(Request $request, $id)
    {
        $old_img = $request->old_image;
    
        if ($request->file('image')) {
    
            unlink($old_img);
            $image = $request->file('image'); //$image = clinic.jpg
    
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //$name_gen =4654654646 .jpg
    
            Image::make($image)->resize(300, 300)->save('upload/Product/' . $name_gen);
    
            $save_url = 'upload/Product/' . $name_gen;
    
            Product::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $save_url,
    
            ]);
            return redirect()->route('product.index')->with('message', 'The product has been successfully modified!');
        } //end id
    
        else {
            Product::findOrFail($id)->update([
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);
    
            return redirect()->route('product.index')->with('message', 'The product has been not successfully modified!');
        } // end else 
    
    
    
    }
    
    
    
    public function show_details($id){
    
        $product= Product::findOrFail($id);
    
        return view ('product.product_details',compact('product'));
    
    
    }
    
    
    
    
    
    
    public function delete($id)
    {
        Product::find($id)->delete();
    
        return redirect()->back()->with('message', ' The product has been deleted successfully  !');
    }
    
}
