<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">


    <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-sky-700 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
        <div class="p-4 text-2xl font-bold border-b border-white/20">
            🌐 Admin<span class="text-yellow-300">Panel</span>
        </div>
        <nav class="p-4 space-y-3">
            <a href="/dashboard" class="flex items-center gap-3 p-2 rounded-md hover:bg-white/20 transition">
                📊 <span>Dashboard</span>
            </a>

            <div>
                <button id="productsToggle"
                    class="w-full flex items-center justify-between gap-3 p-2 rounded-md hover:bg-white/20 transition">
                    <span class="flex items-center gap-3">🛍️ <span>Products</span></span>
                    <span id="productsChevron">▸</span>
                </button>
                <div id="productsSubmenu" class="mt-1 ml-6 space-y-1 hidden">
                    <a href="{{ route('admin.addproducts') }}"
                        class="block p-2 rounded-md hover:bg-white/10 transition">Add Product</a>
                    <a href="{{ route('admin.viewproducts') }}"
                        class="block p-2 rounded-md hover:bg-white/10 transition">View Products</a>
                </div>
            </div>


            <div>
                <button id="categoriesToggle"
                    class="w-full flex items-center justify-between gap-3 p-2 rounded-md hover:bg-white/20 transition">
                    <span class="flex items-center gap-3">📂 <span>Categories</span></span>
                    <span id="categoriesChevron">▸</span>
                </button>
                <div id="categoriesSubmenu" class="mt-1 ml-6 space-y-1 hidden">
                    <a href="{{ route('admin.addcategories') }}"
                        class="block p-2 rounded-md hover:bg-white/10 transition">Add Categories</a>
                    <a href="{{ route('admin.viewcategories') }}"
                        class="block p-2 rounded-md hover:bg-white/10 transition">View Categories</a>
                </div>
            </div>


            <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-white/20 transition">
                👥 <span>Users</span>
            </a>
            @php
                $ordersCount = \App\Models\Order::count();
                $recentOrders = \App\Models\Order::latest()->take(6)->get();
            @endphp

            <div class="relative flex items-center">
                <a href="{{ route('admin.orders.index') }}"
                    class="flex-1 flex items-center gap-3 p-2 rounded-md hover:bg-white/20 transition">
                    📦 <span class="ml-2">Orders</span>
                </a>

                <button id="ordersToggle" class="p-2 rounded-md hover:bg-white/20 transition ml-2">
                    @if ($ordersCount > 0)
                        <span class="bg-yellow-400 text-black text-xs rounded-full px-2">{{ $ordersCount }}</span>
                    @endif
                    <span id="ordersChevron" class="ml-2">▸</span>
                </button>

                <div id="ordersDropdown"
                    class="absolute left-7 mt-2 w-80 bg-gray-900 text-white shadow-lg rounded-md hidden z-50 border border-gray-700">
                    <div class="p-3 border-b border-gray-700 font-semibold text-gray-200">
                        Recent Orders ({{ $ordersCount }})
                    </div>
                    <div class="max-h-64 overflow-auto">
                        @forelse($recentOrders as $ro)
                            <a href="{{ route('admin.orders.index') }}"
                                class="block px-4 py-3 hover:bg-gray-800 border-b border-gray-700 text-sm">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-100">{{ $ro->receiver_email ?? 'Guest' }}</span>
                                    <span class="text-gray-400">#{{ $ro->id }}</span>
                                </div>
                                <div class="text-gray-400 text-xs">
                                    Qty: {{ $ro->quantity }} •
                                    {{ \App\Models\Product::find($ro->product_id)->name ?? 'Product' }}
                                </div>
                            </a>
                        @empty
                            <div class="px-4 py-3 text-sm text-gray-400">No recent orders</div>
                        @endforelse
                    </div>
                    <div class="p-2 text-center border-t border-gray-700">
                        <a href="{{ route('admin.orders.index') }}"
                            class="text-sm text-purple-400 hover:text-purple-300">
                            View all orders
                        </a>
                    </div>
                </div>

            </div>
        </nav>
    </aside>


    <div id="sidebarOverlay" class="hidden md:hidden fixed inset-0 bg-black/40 z-30"></div>


    <div class="flex-1 md:ml-64 flex flex-col min-h-screen">


        <header class="bg-sky-200 shadow-md h-16 flex items-center justify-between px-4 sticky top-0 z-30">

            <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-md hover:bg-gray-200">
                ☰
            </button>


            <div class="hidden md:flex flex-1 mx-6">
                <input type="text" placeholder="Search..."
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-500 outline-none transition">
            </div>

            <div class="flex items-center gap-4">

                <button class="relative hover:scale-110 transition">
                    🔔
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1">5</span>
                </button>


                @auth
                    <div class="relative">
                        <button id="profileBtn" aria-haspopup="true" aria-expanded="false"
                            class="flex items-center gap-2 hover:text-purple-600 transition font-semibold">
                            <span>
                                {{ Auth::user()->name }}
                                @if (Auth::user()->role === 'admin')
                                    <span class="text-sm text-orange-500 font-bold">(Admin)</span>
                                @endif
                            </span>
                            <span class="ml-1">⬇️</span>
                        </button>

                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-44 bg-white shadow-md rounded-md hidden animate-fadeIn"
                            role="menu" aria-labelledby="profileBtn">
                            <a href="{{ url('/profile') }}" class="block px-4 py-2 hover:bg-purple-100"
                                role="menuitem">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-purple-100"
                                    role="menuitem">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </header>

        @yield('dashboard')

        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fadeIn {
                animation: fadeIn 0.3s ease-in-out;
            }
        </style>

        <script>
            function toggleSidebar() {
                const sb = document.getElementById("sidebar");
                const ov = document.getElementById("sidebarOverlay");
                if (!sb) return;
                sb.classList.toggle("-translate-x-full");
                if (ov) ov.classList.toggle('hidden');
            }
        </script>
        <script>
            (function() {
                const btn = document.getElementById('profileBtn');
                const dropdown = document.getElementById('profileDropdown');
                if (!btn || !dropdown) return;

                function open() {
                    dropdown.classList.remove('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                }

                function close() {
                    dropdown.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (dropdown.classList.contains('hidden')) open();
                    else close();
                });


                document.addEventListener('click', (e) => {
                    if (!dropdown.contains(e.target) && !btn.contains(e.target)) close();
                });


                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') close();
                });
            })();
        </script>

        <script>
            (function() {
                const overlay = document.getElementById('sidebarOverlay');
                const sidebar = document.getElementById('sidebar');
                if (overlay) {
                    overlay.addEventListener('click', () => {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                    });
                }


                function setupDropdown(toggleId, menuId, chevronId) {
                    const btn = document.getElementById(toggleId);
                    const menu = document.getElementById(menuId);
                    const chevron = document.getElementById(chevronId);
                    if (!btn || !menu) return;

                    menu.style.transition = 'max-height 220ms ease, opacity 200ms ease';
                    menu.style.overflow = 'hidden';
                    menu.style.maxHeight = menu.classList.contains('hidden') ? '0px' : menu.scrollHeight + 'px';

                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const isHidden = menu.classList.contains('hidden');
                        if (isHidden) {
                            menu.classList.remove('hidden');

                            menu.style.maxHeight = menu.scrollHeight + 'px';
                            menu.style.opacity = '1';
                            if (chevron) chevron.textContent = '▾';
                        } else {

                            menu.style.maxHeight = '0px';
                            menu.style.opacity = '0';
                            if (chevron) chevron.textContent = '▸';
                            setTimeout(() => menu.classList.add('hidden'), 220);
                        }
                    });
                }


                setupDropdown('productsToggle', 'productsSubmenu', 'productsChevron');
                setupDropdown('categoriesToggle', 'categoriesSubmenu', 'categoriesChevron');
                // Orders dropdown toggle
                const ordersToggle = document.getElementById('ordersToggle');
                const ordersDropdown = document.getElementById('ordersDropdown');
                if (ordersToggle && ordersDropdown) {
                    ordersToggle.addEventListener('click', (e) => {
                        e.stopPropagation();
                        ordersDropdown.classList.toggle('hidden');
                    });
                    document.addEventListener('click', (e) => {
                        if (!ordersDropdown.contains(e.target) && e.target !== ordersToggle) ordersDropdown
                            .classList.add('hidden');
                    });
                }
            })();
        </script>

</body>

</html>
