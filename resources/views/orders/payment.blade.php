@extends('layouts.navbar')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
        <h2 class="text-2xl font-semibold mb-4">Payment</h2>

        <div class="mb-4">
            <h3 class="font-medium">Contact</h3>
            <form id="payment-contact-form" action="{{ route('orders.pay') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="block text-sm text-gray-600">Email</label>
                    <input type="email" name="order_email" value="{{ old('order_email', $pending['contact']['email'] ?? '') }}" class="w-full px-3 py-2 border rounded" required>
                    @error('order_email') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-600">Phone</label>
                    <input type="text" name="order_phone" value="{{ old('order_phone', $pending['contact']['phone'] ?? '') }}" class="w-full px-3 py-2 border rounded" required>
                    @error('order_phone') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-600">Address</label>
                    <input type="text" name="order_address" value="{{ old('order_address', $pending['contact']['address'] ?? '') }}" class="w-full px-3 py-2 border rounded" required>
                    @error('order_address') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
            </form>
        </div>

        <div class="mb-4">
            <h3 class="font-medium">Order Summary</h3>
            <table class="w-full mt-2">
                <thead>
                    <tr>
                        <th class="text-left">Product</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending['cart'] as $item)
                    <tr>
                        <td class="py-2">{{ $item['name'] }}</td>
                        <td class="text-right">{{ $item['quantity'] }}</td>
                        <td class="text-right">{{ number_format($item['price'], 2) }}</td>
                        <td class="text-right">{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-semibold">Total</td>
                        <td class="text-right font-semibold">{{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-gray-200 rounded">Back to Cart</a>

            <div class="flex items-center gap-3">
                <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-gray-200 rounded">Back to Cart</a>
                <button form="payment-contact-form" type="submit" class="px-6 py-2 bg-blue-600 text-white rounded">Pay Now</button>
            </div>
        </div>
    </div>
</div>
@endsection
