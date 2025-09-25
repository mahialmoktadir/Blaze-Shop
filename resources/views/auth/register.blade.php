<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blaze | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
            overflow: hidden;
        }

        /* Stars Animation */
        .stars {
            width: 1px;
            height: 1px;
            background: transparent;
            /* box-shadow:
                1000px 200px #FFF, 800px 500px #FFF, 600px 300px #FFF,
                400px 700px #FFF, 200px 900px #FFF, 1200px 600px #FFF,
                300px 200px #FFF, 900px 800px #FFF, 1100px 100px #FFF; */
            animation: animStar 120s linear infinite;
        }
        .stars:after {
            content: " ";
            position: absolute;
            top: 1000px;
            width: 1px;
            height: 1px;
            background: transparent;
            box-shadow:
                1000px 200px #FFF, 800px 500px #FFF, 600px 300px #FFF,
                400px 700px #FFF, 200px 900px #FFF, 1200px 600px #FFF,
                300px 200px #FFF, 900px 800px #FFF, 1100px 100px #FFF;
        }
        @keyframes animStar {
            from { transform: translateY(0px); }
            to { transform: translateY(-1000px); }
        }

        /* Fade In */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 1.2s ease-in-out; }
    </style>
</head>
<body class="h-screen flex items-center justify-center relative">

    <!-- Stars Background -->
    <div class="stars absolute w-full h-full"></div>

    <!-- Register Card -->
    <div class="relative z-10 w-full max-w-md p-8 bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl animate-fadeIn">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-extrabold text-pink-400 drop-shadow-lg">🔥 Blaze</h1>
            <p class="text-gray-300">Create your Blaze account</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-200">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full mt-2 px-4 py-2 rounded-lg bg-black/40 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500 border border-gray-600"
                    placeholder="Enter your name">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-2 px-4 py-2 rounded-lg bg-black/40 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500 border border-gray-600"
                    placeholder="Enter your email">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full mt-2 px-4 py-2 rounded-lg bg-black/40 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500 border border-gray-600"
                    placeholder="Enter your password">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full mt-2 px-4 py-2 rounded-lg bg-black/40 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500 border border-gray-600"
                    placeholder="Confirm your password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400" />
            </div>

            <!-- Actions -->
            <div class="flex flex-col space-y-3 mt-6">
                <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-pink-600 via-purple-500 to-indigo-500 rounded-lg font-bold text-white hover:scale-105 transition transform shadow-lg">
                    🚀 Register
                </button>

                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white text-center">
                    Already registered? Login
                </a>
            </div>
        </form>
    </div>
</body>
</html>
