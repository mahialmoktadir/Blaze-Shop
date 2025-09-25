<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
            overflow-y: auto;
            min-height: 100vh;
        }

        .stars {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background: transparent;
        }

        .stars::before,
        .stars::after {
            content: '';
            position: absolute;
            inset: 0;
            width: 1px;
            height: 1px;
            background: transparent;
            box-shadow:
                40px 30px #FFF, 120px 90px #FFF, 200px 140px #FFF, 320px 260px #FFF,
                480px 380px #FFF, 640px 500px #FFF, 820px 120px #FFF, 980px 640px #FFF,
                1130px 200px #FFF, 1250px 420px #FFF;
            opacity: 0.85;
        }

        .stars::after {
            transform: translateY(600px) scale(0.9);
            opacity: 0.45;
            filter: blur(0.6px);
        }

        @keyframes animStarSlow {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-700px);
            }
        }

        @keyframes animStarFast {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-1200px);
            }
        }

        .stars::before {
            animation: animStarSlow 80s linear infinite;
        }

        .stars::after {
            animation: animStarFast 140s linear infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out both;
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center text-white relative">
    <div class="stars absolute w-full h-full"></div>

    <div class="text-center space-y-6 relative z-10 animate-fadeIn">

        <h1 class="text-5xl md:text-7xl font-extrabold drop-shadow-2xl">
            Welcome to <span class="text-purple-400">Shop Blaze</span>
        </h1>
        <p class="text-lg md:text-xl opacity-90">Explore the Universe of Shopping Blaze 🚀</p>
        <div class="flex flex-col md:flex-row items-center justify-center gap-4 mt-6">
            <a href="{{ route('login') }}"
                class="px-6 py-3 bg-purple-600 hover:bg-purple-500 rounded-lg font-semibold shadow-lg hover:scale-110 transition">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="px-6 py-3 bg-pink-500 hover:bg-pink-400 rounded-lg font-semibold shadow-lg hover:scale-110 transition">
                Register
            </a>
            <a href="dashboard"
                class="px-6 py-3 bg-green-500 hover:bg-green-400 rounded-lg font-semibold shadow-lg hover:scale-110 transition">
                Go to Homepage
            </a>
        </div>
    </div>
</body>

</html>
