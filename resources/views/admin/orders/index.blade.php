@extends('admin.navbar')

@section('dashboard')
<main class="p-6 flex-1">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">📦 Orders</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Product ID</th>
                    <th class="px-4 py-2 border">Customer</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Phone</th>
                    <th class="px-4 py-2 border">Product</th>
                    <th class="px-4 py-2 border">Unit Price</th>
                    <th class="px-4 py-2 border">Qty</th>
                    <th class="px-4 py-2 border">Subtotal</th>
                    <th class="px-4 py-2 border">Address</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-t text-center">
                    <td class="px-4 py-2 border">{{ $order->id }}</td>
                    <td class="px-4 py-2 border">{{ $order->user->name ?? 'Guest' }}</td>
                    <td class="px-4 py-2 border">{{ $order->receiver_email }}</td>
                    <td class="px-4 py-2 border">{{ $order->receiver_phone }}</td>
                    <td class="px-4 py-2 border text-left">{{ $order->product->name ?? 'Product' }}</td>
                    <td class="px-4 py-2 border">${{ number_format($order->product->price ?? 0, 2) }}</td>
                    <td class="px-4 py-2 border">{{ $order->quantity }}</td>
                    <td class="px-4 py-2 border">${{ number_format(($order->product->price ?? 0) * $order->quantity, 2) }}</td>
                    <td class="px-4 py-2 border">{{ $order->receiver_address }}</td>
                    <td class="px-4 py-2 border">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-2 border" id="action-{{ $order->id }}">
    <div class="flex space-x-2">
        <button onclick="confirmOrder({{ $order->id }})"
            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
            Confirm
        </button>
        <button onclick="rejectOrder({{ $order->id }})"
            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
            Reject
        </button>
    </div>
</td>


                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-3 text-center text-gray-500">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
    <script>

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[id^='action-']").forEach(cell => {
        let orderId = cell.id.replace("action-", "");
        let savedStatus = localStorage.getItem("order-status-" + orderId);

        if (savedStatus) {
            if (savedStatus === "confirmed") {
                cell.innerHTML = `<span class="text-green-600 font-semibold">✅ Confirmed</span>`;
            } else if (savedStatus === "rejected") {
                cell.innerHTML = `<span class="text-red-600 font-semibold">❌ Rejected</span>`;
            }
        }
    });
});

function confirmOrder(orderId) {
    localStorage.setItem("order-status-" + orderId, "confirmed");
    document.getElementById(`action-${orderId}`).innerHTML =
        `<span class="text-green-600 font-semibold">✅ Confirmed</span>`;
}

function rejectOrder(orderId) {
    localStorage.setItem("order-status-" + orderId, "rejected");
    document.getElementById(`action-${orderId}`).innerHTML =
        `<span class="text-red-600 font-semibold">❌ Rejected</span>`;
}
</script>


</main>
@endsection
