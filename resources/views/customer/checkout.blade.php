@extends('layouts.customer')

@section('title', 'Checkout - Mie Ganas')

@section('content')
    <input type="hidden" id="customer_table_number" value="{{ session('customer_table_number', 'N/A') }}">
    <input type="hidden" id="customer_name" value="{{ session('customer_name', 'Customer') }}">

    <div class="mb-6 bg-[#f53003] text-white rounded-lg p-4 shadow">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold">Meja Anda: #{{ session('customer_table_number', 'N/A') }}</h2>
                <p class="text-sm opacity-80">Silakan selesaikan pesanan Anda</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ session('customer_name', 'Customer') }}
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-6">Checkout</h2>

            <form id="checkoutForm" action="{{ route('customer.process-order') }}" method="POST">
                @csrf
                <input type="hidden" id="cartData" name="cart_data" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg p-4">
                        <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Ringkasan Pesanan</h3>

                        <div id="orderItems" class="mb-4">
                        </div>

                        <div class="border-t border-gray-200 dark:border-[#3E3E3A] pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Subtotal:</span>
                                <span id="displaySubtotal" class="text-[#1b1b18] dark:text-[#EDEDEC]">Rp 0</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Pajak (11%):</span>
                                <span id="displayTax" class="text-[#1b1b18] dark:text-[#EDEDEC]">Rp 0</span>
                            </div>
                            <div
                                class="flex justify-between text-lg font-bold mt-2 pt-2 border-t border-gray-200 dark:border-[#3E3E3A]">
                                <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Total:</span>
                                <span id="displayTotal" class="text-[#f53003] dark:text-[#FF4433]">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-6">
                            <label for="orderName"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Nama Lengkap *
                            </label>
                            <input type="text" id="orderName" name="name" value="{{ session('customer_name', '') }}"
                                class="w-full px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]"
                                required>
                        </div>

                        <div class="mb-6">
                            <label for="orderNotes"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Catatan Pesanan
                            </label>
                            <textarea id="orderNotes" name="notes" rows="3"
                                class="w-full px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]"
                                placeholder="Contoh: tanpa bawang, pedas sedang, dll"></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
                                Metode Pembayaran *
                            </label>

                            <div class="space-y-3">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="payment_method" value="qris" class="payment-method"
                                        required>
                                    <span class="text-[#1b1b18] dark:text-[#EDEDEC]">QRIS (via Midtrans)</span>
                                </label>

                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="payment_method" value="cash" class="payment-method">
                                    <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Bayar Manual di Kasir</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <button type="submit"
                                class="w-full px-4 py-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                id="confirmOrderBtn" disabled>
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('customer.menu') }}"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg transition duration-300 text-sm dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]">
            Kembali ke Menu
        </a>
    </div>
    </div>

    <script>
        // Helper function to format numbers with commas
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // --- Fungsi untuk Cek Validasi dan Update Tombol ---
        function updateConfirmButtonState(cartData) {
            const confirmBtn = document.getElementById('confirmOrderBtn');
            const orderNameInput = document.getElementById('orderName');
            const paymentMethods = document.querySelectorAll('.payment-method');

            // 1. Cek Keranjang
            const isCartEmpty = cartData.length === 0;

            // 2. Cek Nama
            const isNameFilled = orderNameInput.value.trim() !== '';

            // 3. Cek Metode Pembayaran
            let isPaymentMethodSelected = false;
            paymentMethods.forEach(method => {
                if (method.checked) {
                    isPaymentMethodSelected = true;
                }
            });

            // Tombol aktif jika: keranjang TIDAK kosong, nama terisi, DAN metode pembayaran terpilih
            const isFormValid = !isCartEmpty && isNameFilled && isPaymentMethodSelected;

            confirmBtn.disabled = !isFormValid;

            // Tambahkan class Tailwind CSS untuk styling tombol disabled
            if (!isFormValid) {
                confirmBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
            } else {
                confirmBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            }
        }
        // ---------------------------------------------------


        document.addEventListener('DOMContentLoaded', function() {
            // Get cart data from localStorage (digunakan untuk DISPLAY/TAMPILAN)
            const rawCartData = JSON.parse(localStorage.getItem('customer_cart')) || [];

            // --- FILTER DATA KERANJANG UNTUK DIKIRIM KE SERVER ---
            // Hanya ambil id dan quantity
            const filteredCartData = rawCartData.map(item => ({
                id: item.id,
                quantity: item.quantity,
            }));
            // ---------------------------------------------------


            // Calculate totals (Hanya untuk TAMPILAN di client)
            let subtotal = 0;
            rawCartData.forEach(item => {
                // Gunakan rawCartData yang memiliki 'price' untuk perhitungan tampilan
                subtotal += item.price * item.quantity;
            });

            const tax = subtotal * 0.11; // 11% tax
            const total = subtotal + tax;

            // Populate order items (untuk tampilan)
            const orderItemsContainer = document.getElementById('orderItems');
            if (rawCartData.length === 0) {
                orderItemsContainer.innerHTML =
                    '<p class="text-[#706f6c] dark:text-[#A1A09A]">Keranjang Anda kosong</p>';
            } else {
                let itemsHtml = '';
                rawCartData.forEach(item => {
                    itemsHtml += `
                    <div class="flex justify-between py-2 border-b border-gray-100 dark:border-[#3E3E3A]">
                        <div>
                            <p class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">${item.quantity}x ${item.name}</p>
                        </div>
                        <div>
                            <p class="text-[#f53003] dark:text-[#FF4433]">Rp ${numberWithCommas(item.price * item.quantity)}</p>
                        </div>
                    </div>
                `;
                });
                orderItemsContainer.innerHTML = itemsHtml;
            }

            // Update displayed totals
            document.getElementById('displaySubtotal').textContent = `Rp ${numberWithCommas(subtotal)}`;
            document.getElementById('displayTax').textContent = `Rp ${numberWithCommas(tax)}`;
            document.getElementById('displayTotal').textContent = `Rp ${numberWithCommas(total)}`;

            // Update hidden field cartData
            // PENTING: Menggunakan filteredCartData (hanya id dan quantity)
            document.getElementById('cartData').value = JSON.stringify(filteredCartData);

            // Hidden fields subtotal, tax, total TIDAK LAGI DIISI karena sudah dihapus dari HTML

            // --- Logika Validasi Form ---

            // Panggil pertama kali saat DOMContentLoaded
            updateConfirmButtonState(rawCartData);

            // Event listener untuk input Nama Lengkap
            const orderNameInput = document.getElementById('orderName');
            orderNameInput.addEventListener('input', () => updateConfirmButtonState(rawCartData));

            // Event listener untuk Metode Pembayaran (radio buttons)
            const paymentMethods = document.querySelectorAll('.payment-method');
            paymentMethods.forEach(method => {
                method.addEventListener('change', () => updateConfirmButtonState(rawCartData));
            });

            // --- Form submission handling (tetap sama) ---
            const checkoutForm = document.getElementById('checkoutForm');
            const confirmBtn = document.getElementById('confirmOrderBtn');

            checkoutForm.addEventListener('submit', function(e) {
                // Tambahkan validasi terakhir sebelum submit
                if (confirmBtn.disabled) {
                    e.preventDefault();
                    alert('Harap isi Nama Lengkap dan pilih Metode Pembayaran.');
                    return;
                }

                e.preventDefault();
                // Show loading state
                confirmBtn.innerHTML = 'Memproses...';
                confirmBtn.disabled = true;

                // Serialize form data
                const formData = new FormData(checkoutForm);

                // Submit via AJAX to process order
                fetch(checkoutForm.getAttribute('action'), {
                        method: 'POST',
                        body: formData,
                        headers: {}
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect to thank you page or show success message
                            alert('Pesanan berhasil diproses!');
                            localStorage.removeItem('customer_cart');
                            window.location.href = data.redirect_url || '{{ route('customer.menu') }}';
                        } else {
                            // Show error message and reset button
                            alert('Terjadi kesalahan: ' + (data.message || 'Silakan coba lagi'));
                            confirmBtn.innerHTML = 'Konfirmasi Pesanan';
                            updateConfirmButtonState(
                                rawCartData); // Gunakan fungsi update untuk reset disabled state
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        confirmBtn.innerHTML = 'Konfirmasi Pesanan';
                        updateConfirmButtonState(
                            rawCartData); // Gunakan fungsi update untuk reset disabled state
                    });
            });
        });
    </script>
@endsection
