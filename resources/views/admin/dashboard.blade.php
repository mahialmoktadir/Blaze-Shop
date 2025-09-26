@extends('admin.navbar')
@section('dashboard')
    <main class="p-6 flex-1">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">📊 Dashboard Overview</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div
                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-md rounded-lg p-6 hover:scale-105 transition transform">
                <h2>Total Users</h2>
                <p class="text-3xl font-bold">{{ $totalUsers ?? 0 }}</p>
            </div>
            <div
                class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white shadow-md rounded-lg p-6 hover:scale-105 transition transform">
                <h2>Orders</h2>
                <p class="text-3xl font-bold">{{ $totalOrders ?? 0 }}</p>
            </div>
            <div
                class="bg-gradient-to-r from-green-500 to-teal-500 text-white shadow-md rounded-lg p-6 hover:scale-105 transition transform">
                <h2>Revenue</h2>
                <p class="text-3xl font-bold">${{ number_format($revenue ?? 0, 2) }}</p>
            </div>
        </div>

        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 flex justify-between items-center">
                User Order Totals
                <div class="flex items-center space-x-2">
                    <label class="font-semibold text-gray-700">Sort by:</label>
                    <select id="sortOrders"
                        class="border border-gray-300 rounded-md px-3 py-1 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200 ease-in-out">
                        <option value="high">High to Low Orders</option>
                        <option value="low">Low to High Orders</option>
                        {{-- <option value="newest">Newest Orders</option>
                        <option value="oldest">Oldest Orders</option> --}}
                    </select>
                </div>
            </h2>

            @if (isset($userOrders) && $userOrders->count())
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Total Orders</th>
                        </tr>
                    </thead>
                    <tbody id="userOrdersTable">
                        @foreach ($userOrders as $u)
                            <tr data-orders="{{ $u->total_orders }}" data-date="{{ $u->last_order_date ?? '' }}"
                                class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $u->name }}</td>
                                <td class="px-4 py-2">{{ $u->email }}</td>
                                <td class="px-4 py-2 font-semibold">{{ $u->total_orders }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No user orders yet.</p>
            @endif
        </div>
    </main>

    <!-- JS Sorting with Null-Safe and Smooth Handling -->
    <script>
        document.getElementById('sortOrders').addEventListener('change', function() {
            let option = this.value;
            let tbody = document.getElementById('userOrdersTable');
            let rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const ordersA = parseInt(a.dataset.orders) || 0;
                const ordersB = parseInt(b.dataset.orders) || 0;

                const dateA = a.dataset.date ? new Date(a.dataset.date) : new Date(0);
                const dateB = b.dataset.date ? new Date(b.dataset.date) : new Date(0);

                if (option === 'high') return ordersB - ordersA;
                if (option === 'low') return ordersA - ordersB;
                if (option === 'newest') return dateB - dateA;
                if (option === 'oldest') return dateA - dateB;
            });

            // Smooth re-render
            rows.forEach(r => r.style.opacity = 0);
            tbody.innerHTML = '';
            rows.forEach(r => {
                tbody.appendChild(r);
                r.style.transition = 'opacity 0.3s ease-in-out';
                r.style.opacity = 1;
            });
        });
    </script>
@endsection
