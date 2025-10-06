@extends('layouts.customer')

@section('title', 'Menu - Mie Ganas')

@section('content')
    <!-- Hidden input fields to store customer session data -->
    <input type="hidden" id="customer_table_number" value="{{ session('customer_table_number', 'N/A') }}">
    <input type="hidden" id="customer_name" value="{{ session('customer_name', 'Customer') }}">

    <!-- Table Information Banner -->
    <div class="mb-6 bg-[#f53003] text-white rounded-lg p-4 shadow">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold">Nomor Meja <span
                        class="text-lg font-bold">{{ session('customer_table_number', 'N/A') }}</span>
                </h2>
                <p class="text-sm opacity-80">Selamat datang di Mie Ganas!</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ session('customer_name', 'Customer') }}</span>
            </div>
        </div>
    </div>

    <!-- Search and Category Filter Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <!-- Search Bar -->
            <div class="flex-1">
                <input type="text" id="search-menu" placeholder="Cari menu..."
                    class="w-full px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]">
            </div>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="mb-6 overflow-x-auto">
        <div class="flex space-x-2 pb-2">
            <button class="category-tab px-4 py-2 bg-[#f53003] text-white rounded-lg whitespace-nowrap active-category"
                data-category="all">
                Semua Menu
            </button>
            @foreach ($categories as $category)
                <button
                    class="category-tab px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg whitespace-nowrap dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]"
                    data-category="{{ $category->name }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Menu Items Display -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" id="menu-container">
        @forelse($menuItems as $menu)
            <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
                data-category="{{ $menu->category->name ?? 'uncategorized' }}">
                <div class="h-32 overflow-hidden">
                    @if ($menu->image)
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://placehold.co/400x300" alt="{{ $menu->name }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-3">
                    <h3 class="text-sm font-bold text-[#1b1b18] dark:text-[#EDEDEC]">{{ $menu->name }}</h3>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-bold text-[#f53003] dark:text-[#FF4433]">Rp
                            {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </div>
                    @if ($menu->status === 'active')
                        <div class="quantity-controls flex items-center justify-between">
                            <button
                                class="decrease-qty w-8 h-8 flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-l-md transition duration-300"
                                data-menu-id="{{ $menu->id }}" disabled>
                                -
                            </button>
                            <span
                                class="quantity-value w-10 h-8 flex items-center justify-center bg-gray-100 dark:bg-[#1E1E1C] text-[#1b1b18] dark:text-[#EDEDEC] border-y border-gray-200 dark:border-[#3E3E3A]">
                                0
                            </span>
                            <button
                                class="increase-qty w-8 h-8 flex items-center justify-center bg-[#f53003] hover:bg-[#d92902] text-white rounded-r-md transition duration-300"
                                data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->name }}"
                                data-menu-price="{{ $menu->price }}"
                                data-menu-image="{{ $menu->image ? asset($menu->image) : 'https://placehold.co/400x300' }}">
                                +
                            </button>
                        </div>
                    @else
                        <button class="w-full px-3 py-1.5 bg-gray-400 text-white rounded text-sm cursor-not-allowed"
                            disabled>
                            Habis
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-[#706f6c] dark:text-[#A1A09A] text-lg">Menu tidak ditemukan</p>
            </div>
        @endforelse
    </div>

    <!-- Empty State -->
    <div id="no-results" class="hidden text-center py-12">
        <p class="text-[#706f6c] dark:text-[#A1A09A] text-lg">Menu tidak ditemukan</p>
    </div>

    <!-- Floating Cart Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button id="cartButton"
            class="px-6 py-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-full shadow-lg flex items-center space-x-2 transition duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            <span>Keranjang (0)</span>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cart (load from localStorage if available)
            let cart = JSON.parse(localStorage.getItem('customer_cart')) || [];

            // DOM Elements
            const categoryTabs = document.querySelectorAll('.category-tab');
            const menuItems = document.querySelectorAll('.menu-item');
            const noResults = document.getElementById('no-results');
            const cartButton = document.getElementById('cartButton'); // Menggunakan ID yang sudah ada
            const cartCount = cartButton.querySelector('span');

            // --- CORE FUNCTIONS ---

            // 1. Function to update cart (unchanged)
            function updateCart(menuId, menuName, menuPrice, menuImage, quantity) {
                const existingItemIndex = cart.findIndex(item => item.id == menuId);

                if (quantity > 0) {
                    if (existingItemIndex > -1) {
                        cart[existingItemIndex].quantity = quantity;
                    } else {
                        cart.push({
                            id: menuId,
                            name: menuName,
                            price: menuPrice,
                            image: menuImage,
                            quantity: quantity
                        });
                    }
                } else {
                    if (existingItemIndex > -1) {
                        cart.splice(existingItemIndex, 1);
                    }
                }

                // SIMPAN KE LOCALSTORAGE dan UPDATE TOMBOL setiap kali ada perubahan
                localStorage.setItem('customer_cart', JSON.stringify(cart));
                updateCartCount();
            }

            // 2. Function to update cart count display and manage the floating button
            function updateCartCount() {
                const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
                cartCount.textContent = `Keranjang (${totalItems})`;

                // ⚡ LOGIKA UTAMA UNTUK TOMBOL KERANJANG ⚡
                if (totalItems === 0) {
                    // Nonaktifkan Tombol Keranjang
                    cartButton.disabled = true;
                    // Ubah Warna (menjadi abu-abu)
                    cartButton.classList.remove('bg-[#f53003]', 'hover:bg-[#d92902]');
                    cartButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                } else {
                    // Aktifkan Tombol Keranjang
                    cartButton.disabled = false;
                    // Ubah Warna (menjadi merah)
                    cartButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    cartButton.classList.add('bg-[#f53003]', 'hover:bg-[#d92902]');
                }
            }

            // 3. Function to show cart modal (modified to check cart status)
            function showCartModal() {
                // Jika keranjang kosong, jangan tampilkan modal (walaupun tombol harusnya sudah disabled)
                if (cart.length === 0) {
                    return;
                }

                let modal = document.getElementById('cartModal');
                let checkoutBtn;

                if (!modal) {
                    // (Kode pembuatan Modal HTML Anda di sini, tidak berubah)
                    modal = document.createElement('div');
                    modal.id = 'cartModal';
                    modal.className = 'fixed inset-0 z-50 overflow-y-auto';
                    modal.innerHTML = `
                    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" id="modalBackdrop"></div>
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-[#161615] text-left shadow-xl transition-all sm:my-8 w-full max-w-lg">
                            <div class="bg-white dark:bg-[#161615] px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="w-full">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Keranjang Anda</h3>
                                            <button type="button" class="text-gray-400 hover:text-gray-600" id="closeModal">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="cartItems" class="max-h-96 overflow-y-auto">
                                            </div>
                                        <div class="mt-4">
                                            <div class="flex justify-between text-lg font-bold border-gray-200 dark:border-[#3E3E3A]">
                                                <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Total:</span>
                                                <span id="cartTotal" class="text-[#f53003] dark:text-[#FF4433]">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-[#161615] px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-[#f53003] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#d92902] sm:ml-3 sm:w-auto" id="checkoutBtn">
                                    Checkout
                                </button>
                                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-medium text-[#1b1b18] shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto dark:bg-[#1E1E1C] dark:text-[#EDEDEC] dark:ring-[#3E3E3A] dark:hover:bg-[#2D2D2A]" id="continueShoppingBtn">
                                    Lanjutkan Belanja
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                    document.body.appendChild(modal);
                }

                // Dapatkan tombol checkout setelah modal dibuat/dipilih
                checkoutBtn = document.getElementById('checkoutBtn');

                // ⚡ LOGIKA UTAMA UNTUK TOMBOL CHECKOUT ⚡
                if (cart.length === 0) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.classList.remove('bg-[#f53003]', 'hover:bg-[#d92902]');
                    checkoutBtn.classList.add('bg-gray-400', 'cursor-not-allowed', 'opacity-70',
                        'hover:bg-gray-400');
                } else {
                    checkoutBtn.disabled = false;
                    checkoutBtn.classList.remove('bg-gray-400', 'cursor-not-allowed', 'opacity-70',
                        'hover:bg-gray-400');
                    checkoutBtn.classList.add('bg-[#f53003]', 'hover:bg-[#d92902]');
                }

                renderCartItems();
                modal.style.display = 'block';

                // Re-bind listeners setiap kali modal dibuka (jika modal dibuat dinamis)
                document.getElementById('closeModal').onclick = hideCartModal;
                document.getElementById('continueShoppingBtn').onclick = hideCartModal;
                document.getElementById('modalBackdrop').onclick = hideCartModal;

                // Re-bind checkout listener
                checkoutBtn.onclick = function() {
                    if (!this.disabled) { // Pastikan tombol tidak disabled
                        localStorage.setItem('customer_cart', JSON.stringify(cart));
                        window.location.href = "{{ route('customer.checkout') }}";
                    }
                };
            }

            // 4. Function to hide cart modal (unchanged)
            function hideCartModal() {
                const modal = document.getElementById('cartModal');
                if (modal) {
                    modal.style.display = 'none';
                }
            }

            // 5. Function to render cart items (minor change to re-run updateCartCount)
            function renderCartItems() {
                const cartItemsContainer = document.getElementById('cartItems');
                const cartTotalElement = document.getElementById('cartTotal');

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML =
                        '<p class="text-center text-[#706f6c] dark:text-[#A1A09A] py-4">Keranjang Anda kosong</p>';
                    cartTotalElement.textContent = 'Rp 0';

                    // Tambahan: Tutup modal jika keranjang tiba-tiba kosong dari dalam modal
                    const modal = document.getElementById('cartModal');
                    if (modal && modal.style.display !== 'none') {
                        hideCartModal();
                    }

                    updateCartCount(); // Panggil lagi untuk update tombol floating
                    return;
                }

                // ... (sisa logika renderCartItems Anda yang lama) ...
                let cartItemsHtml = '';
                let total = 0;

                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    cartItemsHtml += `
                    <div class="flex items-center py-3 border-b border-gray-200 dark:border-[#3E3E3A]">
                        <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded-md">
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">${item.name}</h4>
                            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Rp ${numberWithCommas(item.price)}</p>
                        </div>
                        <div class="flex items-center">
                            <button class="decrease-cart-qty w-6 h-6 flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-l text-xs"
                                data-cart-item-id="${item.id}">
                                -
                            </button>
                            <span class="w-8 h-6 flex items-center justify-center bg-gray-100 dark:bg-[#1E1E1C] text-[#1b1b18] dark:text-[#EDEDEC] text-xs">
                                ${item.quantity}
                            </span>
                            <button class="increase-cart-qty w-6 h-6 flex items-center justify-center bg-[#f53003] hover:bg-[#d92902] text-white rounded-r text-xs"
                                data-cart-item-id="${item.id}">
                                +
                            </button>
                        </div>
                        <div class="ml-4 text-sm font-medium text-[#f53003] dark:text-[#FF4433]">
                            Rp ${numberWithCommas(itemTotal)}
                        </div>
                    </div>
                `;
                });

                cartItemsContainer.innerHTML = cartItemsHtml;
                cartTotalElement.textContent = `Rp ${numberWithCommas(total)}`;

                // Re-bind listeners for cart item quantity controls
                document.querySelectorAll('.increase-cart-qty').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const menuId = this.getAttribute('data-cart-item-id');
                        const cartItem = cart.find(item => item.id == menuId);
                        if (cartItem) {
                            cartItem.quantity++;
                            updateCart(cartItem.id, cartItem.name, cartItem.price, cartItem.image,
                                cartItem.quantity); // Menggunakan updateCart
                            renderCartItems();
                            updateMainMenuQuantity(cartItem.id, cartItem.quantity);
                        }
                    });
                });

                document.querySelectorAll('.decrease-cart-qty').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const menuId = this.getAttribute('data-cart-item-id');
                        const cartItem = cart.find(item => item.id == menuId);
                        if (cartItem && cartItem.quantity > 0) {
                            cartItem.quantity--;

                            // Hapus dari cart jika quantity 0
                            const itemToUpdate = cart.find(item => item.id == menuId);
                            const menuName = itemToUpdate.name;
                            const menuPrice = itemToUpdate.price;
                            const menuImage = itemToUpdate.image;

                            updateCart(menuId, menuName, menuPrice, menuImage, cartItem
                            .quantity); // Menggunakan updateCart
                            renderCartItems();
                            updateMainMenuQuantity(menuId, cartItem.quantity);
                        }
                    });
                });

                updateCartCount(); // Panggil lagi untuk update tombol floating
            }

            // 6. Function to update main menu quantity (added call to updateCartCount)
            function updateMainMenuQuantity(menuId, quantity) {
                const menuCard = document.querySelector(`[data-category] .increase-qty[data-menu-id="${menuId}"]`)
                    .closest('.menu-item');
                if (menuCard) {
                    const quantityElement = menuCard.querySelector('.quantity-value');
                    quantityElement.textContent = quantity;

                    const decreaseBtn = menuCard.querySelector('.decrease-qty');
                    if (quantity > 0) {
                        decreaseBtn.disabled = false;
                    } else {
                        decreaseBtn.disabled = true;
                    }
                }

                updateCartCount(); // Panggil untuk memperbarui tombol floating
            }


            // --- INITIALIZATION AND EVENT LISTENERS ---

            // Load cart from localStorage and restore quantities to menu items
            (function initializeCart() {
                const savedCart = JSON.parse(localStorage.getItem('customer_cart'));
                if (savedCart) {
                    cart = savedCart;
                    cart.forEach(item => {
                        const menuCard = document.querySelector(
                                `[data-category] .increase-qty[data-menu-id="${item.id}"]`)
                            .closest('.menu-item');
                        if (menuCard) {
                            const quantityElement = menuCard.querySelector('.quantity-value');
                            quantityElement.textContent = item.quantity;
                            const decreaseBtn = menuCard.querySelector('.decrease-qty');
                            decreaseBtn.disabled = false;
                        }
                    });
                }
                updateCartCount(); // Panggil saat inisialisasi untuk mengatur status tombol awal
            })();

            // Handle cart button click
            cartButton.addEventListener('click', function() {
                if (!this.disabled) {
                    showCartModal();
                }
            });

            // Quantity controls functionality (unchanged logic, but now calls updateCart which saves to LS)
            const increaseQtyButtons = document.querySelectorAll('.increase-qty');
            const decreaseQtyButtons = document.querySelectorAll('.decrease-qty');

            increaseQtyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const menuId = this.getAttribute('data-menu-id');
                    const menuName = this.getAttribute('data-menu-name');
                    const menuPrice = parseFloat(this.getAttribute('data-menu-price'));
                    const menuImage = this.getAttribute('data-menu-image');
                    const quantityElement = this.previousElementSibling;
                    let currentQuantity = parseInt(quantityElement.textContent);

                    currentQuantity++;
                    quantityElement.textContent = currentQuantity;

                    const decreaseBtn = this.previousElementSibling.previousElementSibling;
                    decreaseBtn.disabled = false;

                    updateCart(menuId, menuName, menuPrice, menuImage, currentQuantity);
                });
            });

            decreaseQtyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const menuId = this.getAttribute('data-menu-id');
                    const quantityElement = this.nextElementSibling;
                    let currentQuantity = parseInt(quantityElement.textContent);

                    if (currentQuantity > 0) {
                        currentQuantity--;
                        quantityElement.textContent = currentQuantity;

                        if (currentQuantity === 0) {
                            this.disabled = true;
                        }

                        const increaseBtn = this.nextElementSibling.nextElementSibling;
                        const menuName = increaseBtn.getAttribute('data-menu-name');
                        const menuPrice = parseFloat(increaseBtn.getAttribute('data-menu-price'));
                        const menuImage = increaseBtn.getAttribute('data-menu-image');

                        updateCart(menuId, menuName, menuPrice, menuImage, currentQuantity);
                    }
                });
            });

            // Category Filter & Search (unchanged)
            // ... (sisanya dari kode category dan search Anda) ...
            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');

                    categoryTabs.forEach(t => t.classList.remove('active-category', 'bg-[#f53003]',
                        'text-white'));
                    categoryTabs.forEach(t => t.classList.add('bg-gray-200', 'text-[#1b1b18]',
                        'dark:bg-gray-700', 'dark:text-[#EDEDEC]'));

                    this.classList.add('active-category', 'bg-[#f53003]', 'text-white');
                    this.classList.remove('bg-gray-200', 'text-[#1b1b18]', 'dark:bg-gray-700',
                        'dark:text-[#EDEDEC]');

                    menuItems.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') ===
                            category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    const visibleItems = document.querySelectorAll(
                        '.menu-item:not([style*="display: none"])');
                    if (visibleItems.length === 0) {
                        noResults.style.display = 'block';
                    } else {
                        noResults.style.display = 'none';
                    }
                });
            });
            const searchInput = document.getElementById('search-menu');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasVisibleItem = false;

                menuItems.forEach(item => {
                    const itemName = item.querySelector('h3').textContent.toLowerCase();
                    const itemCategory = item.getAttribute('data-category');

                    const activeCategory = document.querySelector('.active-category').getAttribute(
                        'data-category');
                    const matchesCategory = activeCategory === 'all' || itemCategory ===
                        activeCategory;

                    const matchesSearch = itemName.includes(searchTerm);

                    if (matchesCategory && matchesSearch) {
                        item.style.display = 'block';
                        hasVisibleItem = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (hasVisibleItem) {
                    noResults.style.display = 'none';
                } else {
                    noResults.style.display = 'block';
                }
            });


            // Helper function to format numbers with commas (unchanged)
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
@endsection
