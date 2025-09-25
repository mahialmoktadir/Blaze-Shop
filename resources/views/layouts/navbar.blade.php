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


        <div class="flex-shrink-0 text-2xl font-extrabold text-orange-600 cursor-pointer hover:scale-110 transform transition duration-300">
          Shop<span class="text-gray-800">Blaze</span>
        </div>


        <div class="hidden md:flex flex-1 mx-6">
          <input
            type="text"
            placeholder="Search products..."
            class="w-full px-4 py-2 rounded-l-full border border-gray-300 focus:ring-2 focus:ring-orange-500 outline-none transition"
          >
          <button class="bg-orange-600 text-white px-4 py-2 rounded-r-full hover:bg-orange-700 transform hover:scale-105 transition duration-300">
            🔍
          </button>
        </div>

        <div class="flex items-center gap-6">


          <ul class="hidden md:flex gap-6 text-gray-700 font-medium">
            <li><a href="#" class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Home</a></li>
            <li><a href="#" class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Shop</a></li>
            <li><a href="#" class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Deals</a></li>
            <li><a href="#" class="hover:text-orange-600 hover:underline underline-offset-4 transition duration-300">Contact</a></li>
          </ul>


          <button class="relative hover:scale-110 transition duration-300">
            <svg class="w-7 h-7 text-gray-700 hover:text-orange-600 transition duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6h12.4L17 13M7 13H3m10 9a1 1 0 100-2 1 1 0 000 2zm-6 0a1 1 0 100-2 1 1 0 000 2z"/>
            </svg>
            <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs rounded-full px-1 animate-bounce">3</span>
          </button>


          <button class="hover:scale-110 transition duration-300">
            <svg class="w-8 h-8 text-gray-700 hover:text-orange-600 transition duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9.004 9.004 0 0112 15a9.004 9.004 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </button>


      @if (Route::has('login'))
        <div class="hidden md:flex items-center gap-2">
          @auth
                      <div class="px-4 py-1.5 border rounded-sm text-sm text-gray-800 flex items-center gap-2 border-gray-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/></svg>
                        <span>{{ Auth::user()->name }}</span>
                      </div>

            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-1.5 text-sm text-gray-800 hover:text-orange-600 border border-transparent hover:border-orange-500 rounded-sm transition">
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


          <button onclick="toggleMenu()" class="md:hidden focus:outline-none hover:scale-110 transition duration-300">
            <svg class="w-7 h-7 text-gray-700 hover:text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
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
                    <button type="submit" class="w-full text-left hover:text-orange-600 transition">Log out</button>
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

  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.3s ease-in-out;
    }
  </style>

</body>
</html>
