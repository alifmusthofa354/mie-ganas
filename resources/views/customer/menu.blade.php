@extends('layouts.customer')

@section('title', 'Menu - Mie Ganas')

@section('content')
    <!-- Table Information Banner -->
    <div class="mb-6 bg-[#f53003] text-white rounded-lg p-4 shadow">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold">Meja Anda: #{{ session('customer_table_number', 'N/A') }}</h2>
                <p class="text-sm opacity-80">Selamat datang di Mie Ganas!</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ session('customer_name', 'Customer') }}
                </span>
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

            <!-- Category Filter -->
            <div>
                <select id="category-filter"
                    class="px-4 py-2 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]">
                    <option value="all">Semua Kategori</option>
                    <option value="mie">Mie</option>
                    <option value="minuman">Minuman</option>
                    <option value="snack">Snack</option>
                </select>
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
            <button
                class="category-tab px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg whitespace-nowrap dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]"
                data-category="mie">
                Mie
            </button>
            <button
                class="category-tab px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg whitespace-nowrap dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]"
                data-category="minuman">
                Minuman
            </button>
            <button
                class="category-tab px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg whitespace-nowrap dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]"
                data-category="snack">
                Snack
            </button>
        </div>
    </div>

    <!-- Menu Items Display -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menu-container">
        <!-- Menu items will be populated dynamically -->
        <!-- Mie Category -->
        <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
            data-category="mie">
            <div class="h-48 overflow-hidden">
                <img src="https://placehold.co/400x300" alt="Mie Goreng Spicy" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Mie Goreng Spicy</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">Delicious fried noodles with our signature spicy
                    sauce</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 35,000</span>
                    <span class="text-xs px-2 py-1 bg-green-500 text-white rounded">Tersedia</span>
                </div>
                <button
                    class="add-to-cart w-full px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                    Pesan
                </button>
            </div>
        </div>

        <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
            data-category="mie">
            <div class="h-48 overflow-hidden">
                <img src="https://placehold.co/400x300" alt="Mie Rebus Special" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Mie Rebus Special</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">Our special noodle soup with rich and flavorful
                    broth</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 32,000</span>
                    <span class="text-xs px-2 py-1 bg-red-500 text-white rounded">Habis</span>
                </div>
                <button class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed" disabled>
                    Habis
                </button>
            </div>
        </div>

        <!-- Minuman Category -->
        <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
            data-category="minuman">
            <div class="h-48 overflow-hidden">
                <img src="https://placehold.co/400x300" alt="Es Teh Tarik" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Es Teh Tarik</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">Freshly brewed iced tea with authentic flavor</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 8,000</span>
                    <span class="text-xs px-2 py-1 bg-green-500 text-white rounded">Tersedia</span>
                </div>
                <button
                    class="add-to-cart w-full px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                    Pesan
                </button>
            </div>
        </div>

        <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
            data-category="minuman">
            <div class="h-48 overflow-hidden">
                <img src="https://placehold.co/400x300" alt="Jus Alpukat" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Jus Alpukat</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">Fresh avocado juice with milk and sugar</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 15,000</span>
                    <span class="text-xs px-2 py-1 bg-green-500 text-white rounded">Tersedia</span>
                </div>
                <button
                    class="add-to-cart w-full px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                    Pesan
                </button>
            </div>
        </div>

        <!-- Snack Category -->
        <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
            data-category="snack">
            <div class="h-48 overflow-hidden">
                <img src="https://placehold.co/400x300" alt="Kerupuk" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Kerupuk</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">Crispy shrimp crackers with spicy sauce</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 5,000</span>
                    <span class="text-xs px-2 py-1 bg-green-500 text-white rounded">Tersedia</span>
                </div>
                <button
                    class="add-to-cart w-full px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300">
                    Pesan
                </button>
            </div>
        </div>

        <div class="menu-item bg-white dark:bg-[#1E1E1C] rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden"
            data-category="snack">
            <div class="h-48 overflow-hidden">
                <img src="https://placehold.co/400x300" alt="Pangsit" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Pangsit</h3>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">Crispy fried dumplings with special sauce</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-[#f53003] dark:text-[#FF4433]">Rp 12,000</span>
                    <span class="text-xs px-2 py-1 bg-red-500 text-white rounded">Habis</span>
                </div>
                <button class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed" disabled>
                    Habis
                </button>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <div id="no-results" class="hidden text-center py-12">
        <p class="text-[#706f6c] dark:text-[#A1A09A] text-lg">Menu tidak ditemukan</p>
    </div>

    <!-- Floating Cart Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button
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
            // Category Filter
            const categoryTabs = document.querySelectorAll('.category-tab');
            const menuItems = document.querySelectorAll('.menu-item');
            const noResults = document.getElementById('no-results');

            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');

                    // Update active tab
                    categoryTabs.forEach(t => t.classList.remove('active-category', 'bg-[#f53003]',
                        'text-white'));
                    categoryTabs.forEach(t => t.classList.add('bg-gray-200', 'text-[#1b1b18]',
                        'dark:bg-gray-700', 'dark:text-[#EDEDEC]'));

                    this.classList.add('active-category', 'bg-[#f53003]', 'text-white');
                    this.classList.remove('bg-gray-200', 'text-[#1b1b18]', 'dark:bg-gray-700',
                        'dark:text-[#EDEDEC]');

                    // Filter menu items
                    menuItems.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') ===
                            category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Show/hide no results message
                    const visibleItems = document.querySelectorAll(
                        '.menu-item:not([style*="display: none"])');
                    if (visibleItems.length === 0) {
                        noResults.style.display = 'block';
                    } else {
                        noResults.style.display = 'none';
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('search-menu');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasVisibleItem = false;

                menuItems.forEach(item => {
                    const itemName = item.querySelector('h3').textContent.toLowerCase();
                    const itemCategory = item.getAttribute('data-category');

                    // Check if active category filter allows this item to be shown
                    const activeCategory = document.querySelector('.active-category').getAttribute(
                        'data-category');
                    const matchesCategory = activeCategory === 'all' || itemCategory ===
                        activeCategory;

                    // Check if search term matches
                    const matchesSearch = itemName.includes(searchTerm);

                    if (matchesCategory && matchesSearch) {
                        item.style.display = 'block';
                        hasVisibleItem = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show/hide no results message
                if (hasVisibleItem) {
                    noResults.style.display = 'none';
                } else {
                    noResults.style.display = 'block';
                }
            });

            // Add to cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const cartButton = document.querySelector('.fixed button');
            const cartCount = cartButton.querySelector('span');
            let count = 0;

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    count++;
                    cartCount.textContent = `Keranjang (${count})`;

                    // Show visual feedback
                    const originalText = this.textContent;
                    this.textContent = 'Ditambahkan';
                    this.classList.remove('bg-[#f53003]', 'hover:bg-[#d92902]');
                    this.classList.add('bg-green-500');

                    setTimeout(() => {
                        this.textContent = originalText;
                        this.classList.add('bg-[#f53003]', 'hover:bg-[#d92902]');
                        this.classList.remove('bg-green-500');
                    }, 1000);
                });
            });
        });
    </script>
@endsection
