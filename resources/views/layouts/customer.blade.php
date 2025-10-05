<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta-description', 'Welcome to Mie Ganas - Best Indonesian Noodle Restaurant')">

    <title>@yield('title', 'Mie Ganas - Home')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
    <!-- Header with navigation -->
    <header class="w-full bg-white dark:bg-[#161615] shadow-md py-4 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Mie Ganas</span>
            </a>

            <nav>
                <ul class="flex space-x-6">
                    <li>
                        <a href="/history"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg transition duration-300 text-sm dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]">
                            Riwayat
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full bg-white dark:bg-[#121212] py-6 px-6 border-t border-red-500/20 dark:border-red-600/30">
        <div class="container mx-auto max-w-7xl text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                © {{ date('Y') }} <span class="font-semibold text-red-600 dark:text-red-500">Mie Ganas.</span> Semua
                Hak Dilindungi.
            </p>
        </div>
    </footer>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
