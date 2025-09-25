@extends('admin.navbar')

@section('dashboard')
<main class="p-6 flex-1">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">✏️ Update Product</h1>

    <div class="bg-white shadow rounded-lg p-6 max-w-3xl mx-auto">
        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
        @endif

        {{-- Update Product Form --}}
        <form action="{{ route('admin.updateproduct', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Product Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Title</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 p-2"
                    required>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Description</label>
                <textarea name="description" rows="5"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 p-2">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Quantity --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 p-2"
                    required>
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Price ($)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 p-2"
                    required>
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Category</label>
                <input type="text" name="category" value="{{ old('category', $product->category) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 p-2">
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                @if($product->image)
                    <div class="mb-3">
                        <img src="{{ asset('product_images/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="image" class="w-full text-sm text-gray-600">
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg shadow-md transition">
                    💾 Save Changes
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
