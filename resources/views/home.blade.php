@extends('layouts.navbar')
@section('content')
    {{-- Hero Section --}}
    <section
        class="bg-gradient-to-r from-purple-700 via-pink-600 to-red-500 text-white py-32 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_#ff512f,_transparent_60%)] opacity-50"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_#dd2476,_transparent_60%)] opacity-50">
        </div>

        <h1 class="relative z-10 text-5xl md:text-7xl font-extrabold ">
            Welcome to <span class="text-yellow-300">BLAZE</span> Shop
        </h1>
        <p class="relative z-10 text-lg md:text-2xl mt-4 text-gray-100">
            Ignite Your Shopping Experience
        </p>
        <a href="#shop"
            class="relative z-10 mt-6 inline-block px-10 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-black rounded-full hover:scale-110 transform transition duration-300 font-bold shadow-lg">
            Shop Now
        </a>
    </section>

    {{-- Featured Products --}}
    <section id="shop" class="py-20 max-w-7xl mx-auto px-6">
        <h2
            class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-black to-gray-400 mb-12 text-center drop-shadow-lg">
            Featured Products
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $p)
                <div
                    class="bg-gradient-to-br from-gray-900 via-gray-800 to-black rounded-2xl overflow-hidden shadow-xl hover:shadow-[0_0_25px_rgba(0,0,0,0.7)] hover:-translate-y-2 transform transition duration-300 flex flex-col border border-gray-700">

                    {{-- Product Image --}}
                    <div class="relative bg-gray-900 flex items-center justify-center h-56">
                        <img src="{{ asset('product_images/' . $p->image) }}" alt="{{ $p->name }}"
                            class="w-full h-full rounded-2xl object-cover p-2">
                        <span
                            class="absolute top-2 right-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-black font-bold text-sm px-3 py-1 rounded-full shadow-lg">
                            ${{ $p->price }}
                        </span>
                    </div>


                    {{-- Product Content --}}
                    <div class="p-4 sm:p-5 flex-1 flex flex-col">
                        <h3 class="font-bold text-sm sm:text-lg text-white mb-2">
                            @if (strlen($p->name) > 50)
                                {{ Str::limit($p->name, 50) }}
                                <a href="{{ route('product.view', $p->id) }}"
                                    class="text-pink-400 text-xs sm:text-sm font-medium hover:underline ml-1">See More</a>
                            @else
                                {{ $p->name }}
                            @endif
                        </h3>

                        <p class="text-gray-400 text-xs sm:text-sm mb-3 line-clamp-2">
                            {{ Str::limit($p->description, 80, '...') }}
                        </p>

                        <a href=""
                            class="mt-auto inline-block px-3 sm:px-5 py-2 text-center bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-400 hover:to-indigo-500 text-white font-semibold rounded-lg transition shadow-md text-xs sm:text-base">
                            Buy Now
                        </a>
                        <a href="{{ route('product.view', $p->id) }}"
                            class="px-3 sm:px-5 py-2 bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-400 hover:to-red-400 text-center text-white rounded-lg font-semibold w-full transition mt-2 sm:mt-3 shadow-md text-xs sm:text-base">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
