@extends('layouts.navbar')
@section('content')
    <section
        class="bg-gradient-to-r from-red-600 via-orange-500 to-yellow-400 text-black py-32 text-center relative overflow-hidden">
        <h1 class="text-5xl md:text-7xl font-extrabold drop-shadow-lg">🔥 Welcome to BLAZE Shop</h1>
        <p class="text-lg md:text-2xl mt-4">Ignite Your Shopping Experience</p>
        <a href="#shop"
            class="mt-6 inline-block px-8 py-3 bg-black text-white rounded-lg hover:scale-105 transform transition duration-300 font-semibold">Shop
            Now</a>
    </section>


    <section id="shop" class="py-16 max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-orange-500 mb-8 text-center">🔥 Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                <img src="https://via.placeholder.com/400x250" alt="Product" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Product 1</h3>
                    <p class="text-gray-300 mb-2">$49.99</p>
                    <button
                        class="px-4 py-2 bg-orange-500 hover:bg-orange-400 rounded-lg font-semibold w-full transition">Buy
                        Now</button>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                <img src="https://via.placeholder.com/400x250" alt="Product" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Product 2</h3>
                    <p class="text-gray-300 mb-2">$79.99</p>
                    <button
                        class="px-4 py-2 bg-orange-500 hover:bg-orange-400 rounded-lg font-semibold w-full transition">Buy
                        Now</button>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                <img src="https://via.placeholder.com/400x250" alt="Product" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Product 3</h3>
                    <p class="text-gray-300 mb-2">$99.99</p>
                    <button
                        class="px-4 py-2 bg-orange-500 hover:bg-orange-400 rounded-lg font-semibold w-full transition">Buy
                        Now</button>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                <img src="https://via.placeholder.com/400x250" alt="Product" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">Product 4</h3>
                    <p class="text-gray-300 mb-2">$59.99</p>
                    <button
                        class="px-4 py-2 bg-orange-500 hover:bg-orange-400 rounded-lg font-semibold w-full transition">Buy
                        Now</button>
                </div>
            </div>
        </div>
    </section>


    <section class="py-16 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-orange-500 mb-12">Why Choose BLAZE</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-700 rounded-lg p-6 hover:scale-105 transition">
                    <h3 class="font-bold text-xl mb-2">Fast Delivery</h3>
                    <p class="text-gray-300">Get your products quickly with our blazing fast delivery.</p>
                </div>
                <div class="bg-gray-700 rounded-lg p-6 hover:scale-105 transition">
                    <h3 class="font-bold text-xl mb-2">Premium Quality</h3>
                    <p class="text-gray-300">We provide only high-quality products for our customers.</p>
                </div>
                <div class="bg-gray-700 rounded-lg p-6 hover:scale-105 transition">
                    <h3 class="font-bold text-xl mb-2">24/7 Support</h3>
                    <p class="text-gray-300">Our team is always ready to help you anytime.</p>
                </div>
            </div>
        </div>
    </section>


    <footer class="bg-black bg-opacity-80 py-6 text-center">
        <p class="text-gray-400">&copy; 2025 BLAZE Shop. All rights reserved.</p>
    </footer>
@endsection
