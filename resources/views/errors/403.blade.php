<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Akses Ditolak</title>
    {{-- Menggunakan Vite untuk menyertakan Tailwind CSS --}}
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center p-6 w-full max-w-3xl bg-white rounded-lg shadow-md">
        <div class="mb-4">
            <h1 class="text-5xl font-bold text-red-600">403</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mt-2">🚫 Access Denied!</h2>
        </div>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p>
                {{-- Tampilkan pesan dari Gate/Policy jika ada, jika tidak, tampilkan pesan default --}}
                {{ $exception->getMessage() ?: 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.' }}
            </p>
        </div>
        <div class="mt-6">
            <a href="{{ url('/dashboard') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>

</html>
