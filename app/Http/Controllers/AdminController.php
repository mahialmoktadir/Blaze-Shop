<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
   public function addproducts()
   {
       $categories = Category::all();
       return view('admin.products.create', compact('categories'));
   }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:100',
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
}
    public function viewproducts()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function updateproduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));

    }
    public function postupdateproduct(Request $request, $id){

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category;


    $image = $request->file('image');
    if ($image) {
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('product_images'), $imagename);
        $product->image = $imagename;
    }
        $product->save();
        return redirect()->route('admin.viewproducts')->with('success', 'Product updated successfully!');

    }

    // Update only the category for a product (used by inline select)
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'nullable|string|max:100'
        ]);

        $product = Product::findOrFail($id);
        $product->category = $request->category;
        $product->save();

        return redirect()->back()->with('success', 'Product category updated');
    }
    public function deleteproducts($id)
    {
        $product = Product::findOrFail($id);
        $imagePath = public_path('product_images/' . $product->image);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }
        $product->delete();
        return redirect()->back()->with('success', 'Deleted');

    }

    public function viewProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.view', compact('product'));
}


    // category section
    public function addcategories()
    {
        return view('admin.categories.create');
    }
    public function postaddcategories(request $request)
    {
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->route('admin.viewcategories')->with('success', 'Product added');
    }
    public function viewcategories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function deletecategories($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
}
