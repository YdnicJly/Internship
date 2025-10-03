<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyInternship') }}</title>

    <!-- Styles / Scripts dari Laravel -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Tambah Tailwind CDN supaya styling langsung jalan -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <header class="w-full bg-white shadow-sm fixed top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
                <span class="text-xl font-bold text-blue-600">MyInternship</span>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex space-x-6 text-gray-600">
                <a href="#" class="hover:text-blue-600">Home</a>
                <a href="#" class="hover:text-blue-600">About</a>
                <a href="#" class="hover:text-blue-600">Features</a>
                <a href="#" class="hover:text-blue-600">Announcements</a>
                <a href="#" class="hover:text-blue-600">FAQ</a>
                <a href="#" class="hover:text-blue-600">Contact Us</a>
            </nav>

            <!-- Login Button -->
            <div>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <!-- Text -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Manage your internship <br>
                    with <span class="text-blue-600">MyInternship</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Managing Industrial Learning through Structured Internship
                </p>

                <div class="mt-6 flex space-x-4">
                    <a href="#" class="px-6 py-3 border-2 border-blue-500 text-blue-500 rounded-full hover:bg-blue-500 hover:text-white">
                        Get Started
                    </a>
                  @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                </div>
            </div>

            <!-- Image -->
            <div class="flex justify-center md:justify-end">
                <img src="/internship.png" alt="Internship" class="rounded-lg shadow-lg max-h-[400px]">
            </div>
        </div>
    </section>

</body>
</html>
