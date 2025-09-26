@extends('layouts.navbar')

@section('content')
    <section class="h-full mx-auto mt-10 px-4 py-16">
        <h2 class="text-3xl font-bold text-orange-500 mb-8 text-center">🛒 Your Shopping Cart</h2>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-600 text-white rounded-md shadow">
                {{ session('success') }}
            </div>
        @endif

        @if (count($cart) === 0)
            <div class="text-center text-gray-400 py-20">
                <p class="text-lg">Your cart is empty 😔</p>
                <a href="{{ route('dashboard') }}"
                    class="mt-6 inline-block px-6 py-3 bg-orange-500 hover:bg-orange-400 text-white font-semibold rounded-lg shadow transition">
                    🔥 Continue Shopping
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left: Shopping Cart --}}
                <div class="lg:col-span-2 bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 border-b">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Shopping Cart ({{ $totalItems }} Items)
                        </h3>
                    </div>
                    <div class="divide-y">
                        @foreach ($cart as $item)
                            <div class="flex flex-col md:flex-row items-center justify-between p-6">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('product_images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                        class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <a href="{{ route('product.view', $item['id']) }}"
                                            class="font-semibold text-gray-700">{{ $item['name'] }}</a>
                                        <p class="text-sm text-gray-400">${{ $item['price'] }}</p>
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                            onsubmit="return confirm('Remove this item?');" class="mt-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 text-sm hover:underline">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="flex items-center gap-6 mt-4 md:mt-0">
                                    <form action="{{ route('cart.update', $item['id']) }}" method="POST"
                                        class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center border rounded">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                min="1" class="w-16 px-2 py-1 text-center border-none focus:ring-0">
                                        </div>
                                        <button type="submit"
                                            class="ml-2 px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded">
                                            Update
                                        </button>
                                    </form>
                                    <p class="font-semibold text-gray-700">
                                        ${{ $item['price'] * $item['quantity'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Order Summary --}}
                <div class="bg-gray-50 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                    <div class="flex justify-between mb-2 text-gray-600">
                        <span>Items ({{ $totalItems }})</span>
                        <span>${{ $totalPrice }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-600">
                        <span>Shipping</span>
                        <span>$5.00</span>
                    </div>

                    <form class="mt-4">
                        <label for="promo" class="block text-sm text-gray-500 mb-1">Promo Code</label>
                        <div class="flex">
                            <input id="promo" type="text"
                                class="flex-1 px-3 py-2 border rounded-l-lg focus:outline-none"
                                placeholder="Enter your code">
                            <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-r-lg hover:bg-red-600">
                                Apply
                            </button>
                        </div>
                    </form>

                    <div class="border-t mt-6 pt-4 flex justify-between text-lg font-bold text-gray-800">
                        <span>Total Cost</span>
                        <span>${{ $totalPrice + 5 }}</span>
                    </div>

                    <a href="{{ route('checkout') }}"
                        class="mt-6 block w-full text-center py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow transition">
                        Checkout
                    </a>
                </div>
            </div>
        @endif
    </section>
@endsection
