@extends('admin.navbar')
@section('dashboard')
    <main class="p-6 flex-1">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">📊 Dashboard Overview</h1>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-md rounded-lg p-6 hover:scale-105 transition transform">
          <h2>Total Users</h2>
          <p class="text-3xl font-bold">1,245</p>
        </div>
        <div class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white shadow-md rounded-lg p-6 hover:scale-105 transition transform">
          <h2>Orders</h2>
          <p class="text-3xl font-bold">532</p>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white shadow-md rounded-lg p-6 hover:scale-105 transition transform">
          <h2>Revenue</h2>
          <p class="text-3xl font-bold">$12,340</p>
        </div>
      </div>

      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
          <thead class="bg-purple-50">
            <tr class="text-gray-700">
              <th class="px-4 py-2">Order ID</th>
              <th class="px-4 py-2">Customer</th>
              <th class="px-4 py-2">Status</th>
              <th class="px-4 py-2">Amount</th>
              <th class="px-4 py-2">Date</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-purple-50 transition">
              <td class="px-4 py-2">#1001</td>
              <td class="px-4 py-2">Mahi</td>
              <td class="px-4 py-2 text-green-600 font-semibold">Completed</td>
              <td class="px-4 py-2">$120</td>
              <td class="px-4 py-2">2025-09-20</td>
            </tr>
            <tr class="hover:bg-purple-50 transition">
              <td class="px-4 py-2">#1002</td>
              <td class="px-4 py-2">Al Moktadir</td>
              <td class="px-4 py-2 text-yellow-600 font-semibold">Pending</td>
              <td class="px-4 py-2">$85</td>
              <td class="px-4 py-2">2025-09-21</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>

@endsection
