<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta-description', 'Aplikasi Dashboard untuk Mie Ganas')">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard - Mie Ganas')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
    <header class="w-full bg-white dark:bg-[#161615] shadow-md py-4 px-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Mie Ganas Dashboard</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/" class="text-[#f53003] dark:text-[#FF4433] hover:underline">Home</a></li>
                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-[#f53003] dark:text-[#FF4433] hover:underline">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="w-full bg-white dark:bg-[#161615] py-4 px-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
        <p class="text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">© {{ date('Y') }} Mie Ganas. All rights
            reserved.</p>
    </footer>
</body>

</html>
