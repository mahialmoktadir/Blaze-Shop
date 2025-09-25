<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function toggleMenu() {
            document.getElementById("mobileMenu").classList.toggle("hidden");
        }
    </script>
</head>

<body class="bg-gray-100">


    <nav class="bg-white shadow-lg sticky top-0 z-50 transition duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">


                <div
                    class="flex-shrink-0 text-2xl font-extrabold text-orange-600 cursor-pointer hover:scale-110 transform transition duration-300">
                    Shop<span class="text-gray-800">Blaze</span>
                </div>


                <div class="hidden md:flex flex-1 mx-6">
                    <input type="text" placeholder="Search products..."
                        class="w-full px-4 py-2 rounded-l-full border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition">
                    <button
                        class="bg-orange-600 text-white px-4 py-2 rounded-r-full hover:bg-orange-700 transform hover:scale-105 transition duration-300">
                        🔍
                    </button>
                </div>

                <div class="flex items-center gap-6">


                    <ul class="hidden md:flex gap-6 text-gray-700 font-medium">
                        <li><a href="{{ route('dashboard') }}"
                                class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Home</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Shop</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Deals</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Contact</a>
                        </li>
                    </ul>


                    <button class="relative hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7 text-gray-700 hover:text-orange-600 transition duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6h12.4L17 13M7 13H3m10 9a1 1 0 100-2 1 1 0 000 2zm-6 0a1 1 0 100-2 1 1 0 000 2z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs rounded-full px-1 animate-bounce">3</span>
                    </button>


                    <button class="hover:scale-110 transition duration-300">
                        <svg class="w-8 h-8 text-gray-700 hover:text-orange-600 transition duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9.004 9.004 0 0112 15a9.004 9.004 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>


                    @if (Route::has('login'))
                        <div class="hidden md:flex items-center gap-2">
                            @auth
                                <div
                                    class="px-4 py-1.5 border rounded-sm text-sm text-gray-800 flex items-center gap-2 border-gray-300">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                                    </svg>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-1.5 text-sm text-gray-800 hover:text-orange-600 border border-transparent hover:border-orange-500 rounded-sm transition">
                                        Log out
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-4 py-1.5 text-sm text-gray-800 hover:text-orange-600 border border-transparent hover:border-orange-500 rounded-sm transition">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="px-4 py-1.5 text-sm text-gray-800 hover:text-orange-600 border border-gray-300 hover:border-orange-500 rounded-sm transition">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif


                    <button onclick="toggleMenu()"
                        class="md:hidden focus:outline-none hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7 text-gray-700 hover:text-orange-600" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>


        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 animate-fadeIn">
            <ul class="flex flex-col p-4 space-y-3 text-gray-700 font-medium">
                <li><a href="#" class="hover:text-orange-600 transition duration-300">Home</a></li>
                <li><a href="#" class="hover:text-orange-600 transition duration-300">Shop</a></li>
                <li><a href="#" class="hover:text-orange-600 transition duration-300">Deals</a></li>
                <li><a href="#" class="hover:text-orange-600 transition duration-300">Contact</a></li>


                @if (Route::has('login'))
                    @auth
                        <li class="font-medium text-gray-800">{{ Auth::user()->name }}</li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left hover:text-orange-600 transition">Log
                                    out</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-orange-600 transition">Log in</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="hover:text-orange-600 transition">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>
    @yield('content')
    {{-- Footer Section --}}
    <footer class="bg-black text-gray-300 pt-20">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Top Header --}}
            <h2 class="text-5xl md:text-7xl font-extrabold text-white text-center mb-12 tracking-wide">
                BLAZE SHOPING
            </h2>

            {{-- Info Boxes --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-gray-900 p-6 rounded-lg border border-gray-700">
                    <h3 class="flex items-center text-lg font-bold mb-2 text-white">
                        <span class="mr-2">📦</span> Shipping
                    </h3>
                    <p class="text-gray-400 text-sm">
                        In-stock items shipped via White Glove or oversize will typically ship within 2–3 weeks of
                        purchase,
                        unless otherwise noted. Transit can take up to 14 business days.
                    </p>
                </div>

                <div class="bg-gray-900 p-6 rounded-lg border border-gray-700">
                    <h3 class="flex items-center text-lg font-bold mb-2 text-white">
                        <span class="mr-2">🚚</span> Delivery
                    </h3>
                    <p class="text-gray-400 text-sm">
                        Delivery requires an appointment and signature. A two-person team will bring the item inside,
                        place
                        it in your chosen room, assemble it, and remove packaging debris.
                    </p>
                </div>

                <div class="bg-gray-900 p-6 rounded-lg border border-gray-700">
                    <h3 class="flex items-center text-lg font-bold mb-2 text-white">
                        <span class="mr-2">↩️</span> Returns
                    </h3>
                    <p class="text-gray-400 text-sm">
                        Please verify that this item aligns with your requirements before purchase, as it does not
                        qualify
                        for free returns and incurs a 15% restocking fee.
                    </p>
                </div>
            </div>

            {{-- Bottom Links --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 border-t border-gray-800 pt-10 pb-6">
                {{-- Social Media --}}
                <div>
                    <h4 class="text-white font-bold mb-4">Social Media</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Facebook</a></li>
                        <li><a href="#" class="hover:text-white transition">Pinterest</a></li>
                        <li><a href="#" class="hover:text-white transition">Instagram</a></li>
                        <li><a href="#" class="hover:text-white transition">TikTok</a></li>
                    </ul>
                </div>

                {{-- Customer Support --}}
                <div>
                    <h4 class="text-white font-bold mb-4">Customer Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Top Questions</a></li>
                        <li><a href="#" class="hover:text-white transition">Start a Return</a></li>
                        <li><a href="#" class="hover:text-white transition">Rug Guide</a></li>
                        <li><a href="#" class="hover:text-white transition">Gift Card</a></li>
                    </ul>
                </div>

                {{-- Company --}}
                <div>
                    <h4 class="text-white font-bold mb-4">The Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Customer Reviews</a></li>
                        <li><a href="#" class="hover:text-white transition">Accessibility</a></li>
                    </ul>
                </div>

                {{-- Subscribe --}}
                <div>
                    <h4 class="text-white font-bold mb-4">Subscribe To Us!</h4>
                    <p class="text-sm text-gray-400 mb-4">
                        Sign Up For Our Email List And Receive 10% Off Your First Order.
                    </p>
                    <form class="flex items-center border border-gray-600 rounded overflow-hidden">
                        <input type="email" placeholder="Your Email Address"
                            class="w-full px-3 py-2 bg-transparent text-gray-200 placeholder-gray-400 focus:outline-none text-sm">
                        <button type="submit"
                            class="px-4 py-2 bg-yellow-400 text-black font-bold text-sm hover:bg-yellow-300">
                            →
                        </button>
                    </form>
                </div>
            </div>

            {{-- Bottom Copyright --}}
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                &copy; 2025 <span class="text-white">BLAZE Shop</span>. All rights reserved.
            </div>
        </div>
    </footer>
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

</body>

</html>
