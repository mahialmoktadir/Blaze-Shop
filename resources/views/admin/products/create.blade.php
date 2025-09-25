@extends('admin.navbar')

@section('dashboard')
<main class="p-6 flex-1">
  <h1 class="text-2xl font-bold mb-6 text-gray-800">➕ Add Product</h1>

  <div class="bg-white shadow rounded-lg p-6">
    <form action="{{route('admin.postaddproducts')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Product Name</label>
          <input name="name" maxlength="70" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Enter product name in 70 characters"/>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Price (USD)</label>
          <input name="price" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Enter ammount" />
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" rows="4" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Product description..."></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Image</label>
          <input type="file" name="image" class="mt-1 block w-full" />
        </div>

        <select>
            @foreach ($categories as $cat)
            <option class="mt-1 block w-full border rounded px-3 py-2" value="{{$cat->category}}">{{$cat->category}}</option>
            {{-- <input name="category" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Enter category name" /> --}}
            @endforeach
        </select>

      </div>

      <div class="mt-6 flex gap-3">
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Add Product</button>
        <a href="{{route('admin.viewproducts')}}" class="px-4 py-2 border rounded">View Products</a>
      </div>
    </form>
  </div>
</main>
@endsection
