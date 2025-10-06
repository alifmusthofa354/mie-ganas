<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pilih nomor meja Anda - Mie Ganas">

    <title>Pilih Meja - Mie Ganas</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white dark:bg-[#161615] shadow-lg rounded-xl p-6 sm:p-8">

            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-[#f53003] dark:text-[#f53003] mb-2">Mie Ganas</h1>
            </div>

            <form id="tableForm" action="{{ route('customer.select-table') }}" method="POST">
                @csrf
                <div class="mb-8">
                    <div class="mb-4  text-center">
                        <label class="text-xl font-semibold text-gray-700 dark:text-gray-300 ">
                            — Pilih nomor meja Anda —
                        </label>
                        <label for="table_number" class="sr-only">Pilih Nomor Meja</label>

                    </div>


                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                        @for ($i = 1; $i <= 20; $i++)
                            <button type="button"
                                class="table-number-btn w-full h-12 flex items-center justify-center rounded-lg border border-gray-300 text-[#1b1b18] hover:bg-orange-100 dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:bg-red-900/50 transition duration-300"
                                data-number="{{ $i }}">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="table_number" id="selectedTableNumber" value="">
                    @error('table_number')
                        <p class="mt-4 text-sm text-red-600 text-center font-medium">⚠️ Mohon pilih nomor meja.</p>
                    @enderror
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full px-4 py-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    Mulai Pesan
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    Atau gunakan cara otomatis:
                </p>
                <button onclick="scanQRCode()"
                    class="mt-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg transition duration-300 text-sm dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]">
                    Scan QR Code
                </button>
            </div>
        </div>

        <div class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            <p>© {{ date('Y') }} Mie Ganas. All rights reserved.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableButtons = document.querySelectorAll('.table-number-btn');
            const selectedTableInput = document.getElementById('selectedTableNumber');
            const submitBtn = document.getElementById('submitBtn');

            // Kelas untuk tombol yang aktif (terpilih)
            const activeClasses = ['bg-[#f53003]', 'text-white', 'border-[#f53003]', 'hover:bg-[#d92902]'];
            // Kelas untuk tombol yang tidak aktif (untuk hover orange muda)
            const inactiveHoverClasses = ['hover:bg-orange-100', 'dark:hover:bg-red-900/50'];

            // Tangani pemilihan nomor meja
            tableButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Hapus kelas aktif dari semua tombol
                    tableButtons.forEach(btn => {
                        btn.classList.remove(...activeClasses);
                        btn.classList.add(...inactiveHoverClasses);
                    });

                    // Tambahkan kelas aktif ke tombol yang diklik
                    this.classList.add(...activeClasses);
                    this.classList.remove(...inactiveHoverClasses);

                    // Set nomor meja yang dipilih
                    const tableNumber = this.getAttribute('data-number');
                    selectedTableInput.value = tableNumber;

                    // AKTIFKAN TOMBOL SUBMIT
                    submitBtn.disabled = false;
                });
            });

            // Fungsi untuk simulasi scan QR code tetap ada
            window.scanQRCode = function() {
                alert(
                    'Fitur scan QR Code akan diimplementasikan. Pada implementasi sebenarnya, ini akan membuka kamera untuk scan kode QR.'
                );
            };
        });
    </script>

    <!-- SCRIPT PENTING UNTUK MENGHAPUS LOCAL STORAGE SAAT REDIRECT LOGOUT -->
    @if (session('success-logout'))
        <script>
            // Logika: Jika ada pesan 'success' yang dibawa dari redirect, 
            // kita asumsikan itu adalah redirect dari logout,
            // dan kita hapus keranjang belanja.
            // Metode ini aman karena pesan 'success' hanya muncul setelah action server.

            try {
                localStorage.removeItem('customer_cart');
                console.log('Keranjang belanja (customer_cart) berhasil dihapus saat logout.');

                // Opsional: Hapus pesan success dari session browser agar script ini tidak dijalankan lagi
                // di refresh berikutnya (walaupun Laravel sudah menangani ini secara otomatis)
            } catch (e) {
                console.error('Gagal menghapus localStorage:', e);
            }
        </script>
    @endif
</body>

</html>
