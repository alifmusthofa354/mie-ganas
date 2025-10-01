<html>
<head>
    <title>403 Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">🚫 Akses Ditolak!</h4>
            <p>
                {{-- Tampilkan pesan dari Gate/Policy jika ada, jika tidak, tampilkan pesan default --}}
                {{ $exception->getMessage() ?: 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.' }}
            </p>
        </div>
        <hr>
        <p class="mb-0">
            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
        </p>
    </div>
</body>
</html>
