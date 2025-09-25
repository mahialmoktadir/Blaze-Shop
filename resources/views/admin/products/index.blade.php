@extends('admin.navbar')

@section('dashboard')
    <main class="p-6 flex-1">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">🛍️ Products</h1>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            @if (session('success'))
                <div class="p-4 text-green-700 bg-green-100">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="p-4 text-red-700 bg-red-100">{{ session('error') }}</div>
            @endif

            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="text-sm text-gray-600">Showing <strong>{{ count($product) }}</strong> products</div>
                    <a href="{{ route('admin.addproducts') }}"
                        class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                        ➕ Add Product
                    </a>
                </div>

                @if (empty($product))
                    <div class="p-8 text-center text-gray-600">No products yet. Click "Add Product" to get started.</div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($product as $p)
                            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col h-[500px]">
    <div class="h-56 bg-gray-100">
        @if (!empty($p['image']))
            <img src="{{ asset($p['image']) }}" alt="{{ $p['name'] }}" class="w-full h-56 object-cover">
        @else
            <div class="w-full h-56 flex items-center justify-center text-gray-400">No image</div>
        @endif
    </div>

    <div class="p-4 flex-1 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">{{ $p['name'] }}</h3>
            <div class="text-sm text-gray-500 mt-1">{{ $p['category'] ?? 'Uncategorized' }}</div>
            <div class="text-xl font-bold text-green-600 mt-2">${{ $p['price'] }}</div>
            <p class="mt-3 text-sm text-gray-600 line-clamp-3">{{ $p['description'] ?? '' }}</p>
        </div>

        <form action="{{ route('admin.deleteproducts', $p->id) }}" method="POST"
              onsubmit="return confirm('Delete this product?');" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full text-center text-red-600 hover:text-red-800 font-medium py-2 border-t border-gray-200">
                🗑️ Delete
            </button>
        </form>
    </div>
</div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
