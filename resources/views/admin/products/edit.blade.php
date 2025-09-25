@extends('admin.navbar')

@section('dashboard')
    <main class="p-6 flex-1">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Product</h1>

        <div class="bg-white shadow rounded-lg p-6">
            @if (session('success'))
                <div class="p-4 text-green-700 bg-green-100">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.postupdateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input name="name" value="{{ old('name', $product->name) }}" maxlength="100" class="mt-1 block w-full border rounded px-3 py-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Price (USD)</label>
                        <input name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border rounded px-3 py-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" class="mt-1 block w-full border rounded px-3 py-2">
                            <option value="">-- Select category (optional) --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->category }}" @if($product->category == $cat->category) selected @endif>{{ $cat->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        @if ($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('product_images/' . $product->image) }}" alt="{{ $product->name }}" class="w-28 h-28 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="image" class="mt-1 block w-full" />
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
                    <a href="{{ route('admin.viewproducts') }}" class="px-4 py-2 border rounded">Back</a>
                </div>
            </form>
        </div>
    </main>
@endsection
