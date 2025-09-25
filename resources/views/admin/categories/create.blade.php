@extends('admin.navbar')

@section('dashboard')
<main class="p-6 flex-1">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">➕ Add Categories</h1>

    @if (session('category_message'))
    <div class="p-4 text-green-700 bg-green-100">{{ session('category_message') }}</div>
    @endif
   <form action="{{route('admin.postaddcategories')}}" method="POST">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Categorie Name</label>
          <input name="category" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Enter category name" />
        </div>
        <div class="mt-6 flex gap-3">
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Add Categories</button>
        <a href="{{route('admin.viewcategories')}}" class="px-4 py-2 border rounded">View Categories</a>
      </div>
      </div>
</main>
@endsection
