@extends('admin.navbar')

@section('dashboard')
    <main class="p-6 flex-1 bg-gray-50 min-h-screen">
        <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800">🛍️ Manage Products</h1>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div class="p-4 text-green-700 bg-green-100 text-sm md:text-base border-b border-green-200">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 text-red-700 bg-red-100 text-sm md:text-base border-b border-red-200">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <div class="p-4 md:p-6">
                {{-- Header --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">
                    <div class="text-sm text-gray-600">
                        Showing <strong>{{ $products->total() }}</strong> products
                    </div>
                    <a href="{{ route('admin.addproducts') }}"
                        class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm md:text-base font-medium shadow transition">
                        ➕ Add Product
                    </a>
                </div>

                {{-- Table --}}
                @if ($products->isEmpty())
                    <div class="p-8 text-center text-gray-600">
                        No products yet. Click <span class="font-semibold">"Add Product"</span> to get started.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700 text-sm md:text-base">
                                    <th class="py-3 px-4 text-left font-semibold">SL</th>
                                    <th class="py-3 px-4 text-left font-semibold">Title</th>
                                    <th class="py-3 px-4 text-left font-semibold">Description</th>
                                    <th class="py-3 px-4 text-left font-semibold">Quantity</th>
                                    <th class="py-3 px-4 text-left font-semibold">Price</th>
                                    <th class="py-3 px-4 text-left font-semibold">Category</th>
                                    <th class="py-3 px-4 text-left font-semibold">Image</th>
                                    <th class="py-3 px-4 text-center font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr class="border-t border-gray-200 hover:bg-gray-50 transition">
                                        {{-- Serial Number --}}
                                        <td class="py-4 px-4 text-sm text-gray-800">
                                            {{ $loop->iteration + ($products->firstItem() - 1) }}
                                        </td>
                                        {{-- Product Title --}}
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900">{{ $p->name }}</td>

                                        {{-- Description --}}
                                        <td class="py-4 px-4 text-sm text-gray-600 max-w-6xl">
                                            @php
                                                $desc = $p->description ?? 'No description available';
                                            @endphp

                                            @if (strlen($desc) > 200)
                                                <span id="short-{{ $p->id }}">
                                                    {{ Str::limit($desc, 200, '...') }}
                                                </span>
                                                <span id="full-{{ $p->id }}" style="display: none;">
                                                    {{ $desc }}
                                                </span>
                                                <a href="javascript:void(0);" onclick="toggleDesc({{ $p->id }})"
                                                    class="text-blue-500 hover:underline ml-1 text-sm"
                                                    id="btn-{{ $p->id }}">
                                                    See More
                                                </a>
                                            @else
                                                {{ $desc }}
                                            @endif
                                        </td>

                                        {{-- Quantity --}}
                                        <td class="py-4 px-4 text-sm text-gray-700">{{ $p->quantity }}</td>

                                        {{-- Price --}}
                                        <td class="py-4 px-4 text-sm font-semibold text-gray-800">${{ $p->price }}</td>

                                        {{-- Category --}}
                                        <td class="py-4 px-4 text-sm text-gray-600">
                                            {{ $p->category ?? 'Uncategorized' }}
                                        </td>

                                        {{-- Product Image --}}
                                        <td class="py-4 px-4 text-sm">
                                            @if ($p->image)
                                                <img src="{{ asset('product_images/' . $p->image) }}"
                                                    alt="{{ $p->name }}"
                                                    class="w-12 h-12 rounded-md object-cover border border-gray-200">
                                            @else
                                                <span class="text-gray-500">No image</span>
                                            @endif
                                        </td>

                                        {{-- Action --}}
                                        <td class="py-4 px-4 text-sm text-center">
                                            <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                                                {{-- Update Button --}}
                                                <a href="{{ route('admin.updateproduct', $p->id) }}"
                                                    class="px-3 py-1.5 rounded-md bg-blue-500 text-white text-sm font-medium hover:bg-blue-600 transition">
                                                    ✏️ Update
                                                </a>

                                                {{-- Delete Button --}}
                                                <form action="{{ route('admin.deleteproducts', $p->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 rounded-md bg-red-500 text-white text-sm font-medium hover:bg-red-600 transition">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Toggle Description Script --}}
        <script>
            function toggleDesc(id) {
                const shortText = document.getElementById(`short-${id}`);
                const fullText = document.getElementById(`full-${id}`);
                const btn = document.getElementById(`btn-${id}`);

                if (shortText.style.display === "none") {
                    shortText.style.display = "inline";
                    fullText.style.display = "none";
                    btn.innerText = "See More";
                } else {
                    shortText.style.display = "none";
                    fullText.style.display = "inline";
                    btn.innerText = "See Less";
                }
            }
        </script>
    </main>
@endsection
