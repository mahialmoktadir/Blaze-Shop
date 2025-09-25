<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
   public function addproducts()
   {
        $categories=category::all();
        return view('admin.products.create' , compact('categories'));
   }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:70',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'category' => 'nullable|string|max:100',
    ]);

    $product = new Product;
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->category = $request->category;

    // Handle image upload
    $image = $request->file('image');
    if ($image) {
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('product_images'), $imagename);
        $product->image = $imagename;
    }
    $product->save();
    return redirect()->route('admin.viewproducts')->with('success', 'Product added successfully!');

    if($image && $product->save()){
        $request->image->move('product_images',$image);
    }
}
    public function viewproducts()
    {
        $product=product::all();
        return view('admin.products.index' , compact('product'));
    }

    public function deleteproducts($id)
    {
        $product=product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Deleted');

    }

    // category section
    public function addcategories()
    {
        return view('admin.categories.create');
    }
    public function postaddcategories(request $request)
    {
        $category=new category();
        $category->category=$request->category;
        $category->save();
        return redirect()->route('admin.viewcategories')->with('success', 'Product added');
    }
    public function viewcategories()
    {
        $categories=category::all();
        return view('admin.categories.index' , compact('categories'));
    }
    public function deletecategories($id)
    {
        $category=category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
}
