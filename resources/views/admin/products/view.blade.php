@extends('layouts.navbar')

@section('content')
    <section class="max-w-7xl max-lg:h-full mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Product Image --}}
            <div class="flex items-center justify-center bg-gray-50 rounded-xl shadow-md p-6">
                <img src="{{ asset('product_images/' . $product->image) }}" alt="{{ $product->name }}"
                    class="max-h-[600px] w-auto object-contain">
            </div>

            {{-- Product Details --}}
            <div class="flex flex-col space-y-6">
                {{-- Product Name --}}
                <h1 class="text-4xl font-bold text-gray-900 leading-tight">
                    {{ $product->name }}
                </h1>

                {{-- Price --}}
                <p class="text-3xl font-semibold text-gray-800">
                    ${{ number_format($product->price, 2) }}
                </p>

                {{-- Swatches (Demo colors) --}}
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded border border-gray-300 bg-gray-200 cursor-pointer"></div>
                    <div class="w-8 h-8 rounded border border-gray-300 bg-black cursor-pointer"></div>
                    <div class="w-8 h-8 rounded border border-gray-300 bg-white cursor-pointer"></div>
                </div>

                {{-- Stock & Category --}}
                <div class="text-sm text-gray-600 space-y-1">
                    <p>📦 Category: <span class="font-medium">{{ $product->category ?? 'Uncategorized' }}</span></p>
                    <p>✅ In Stock: <span class="font-medium">{{ $product->quantity }}</span></p>
                </div>

                {{-- Description --}}
                @php
                    $maxLength = 300;
                    $fullDescription = $product->description ?? 'No description available.';
                    $isLong = strlen($fullDescription) > $maxLength;
                    $shortDescription = $isLong ? substr($fullDescription, 0, $maxLength) . '...' : $fullDescription;
                @endphp

                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                    <p id="descText" class="text-gray-700 leading-relaxed line-clamp-3 overflow-hidden">
                        {{ $fullDescription }}
                    </p>
                    <button id="toggleBtn" class="mt-2 text-sm text-gray-900 font-medium underline hover:text-gray-600">
                        See More
                    </button>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-black transition">
                            Add to Cart
                        </button>
                    </form>

                    <button id="quickBuyBtn"
                        class="px-6 py-3 bg-gray-100 text-gray-900 font-semibold rounded-lg shadow-md hover:bg-gray-200 transition">
                        Buy Now
                    </button>
                </div>

                {{-- Inline Quick Payment (hidden initially) --}}
                <div id="quickPayment" class="mt-6 bg-white p-4 rounded-lg shadow hidden">
                    <h3 class="font-semibold mb-2">Quick Payment</h3>
                    <form id="quickPaymentForm" method="POST" action="{{ route('orders.pay') }}">
                        @csrf
                        <div class="mb-2">
                            <input type="email" name="order_email" placeholder="Email" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="order_phone" placeholder="Phone" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="order_address" placeholder="Address" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" id="quickCancel" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 4;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>

        <script>
            const desc = document.getElementById('descText');
            const btn = document.getElementById('toggleBtn');

            btn.addEventListener('click', () => {
                if (desc.classList.contains('line-clamp-3')) {
                    desc.classList.remove('line-clamp-3');
                    btn.innerText = "See Less";
                } else {
                    desc.classList.add('line-clamp-3');
                    btn.innerText = "See More";
                }
            });

            // Quick Buy logic
            const quickBuyBtn = document.getElementById('quickBuyBtn');
            const quickPayment = document.getElementById('quickPayment');
            const quickCancel = document.getElementById('quickCancel');

            quickBuyBtn && quickBuyBtn.addEventListener('click', async () => {
                quickBuyBtn.disabled = true;
                try {
                    const res = await fetch("{{ route('orders.buy', $product->id) }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (res.ok) {
                        // show the inline quick payment form
                        quickPayment.classList.remove('hidden');
                        quickPayment.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        const body = await res.json().catch(() => ({}));
                        alert(body.message || 'Could not initiate quick buy.');
                    }
                } catch (err) {
                    console.error(err);
                    alert('Network error');
                } finally {
                    quickBuyBtn.disabled = false;
                }
            });

            quickCancel && quickCancel.addEventListener('click', () => {
                quickPayment.classList.add('hidden');
            });
        </script>
    </section>
@endsection
