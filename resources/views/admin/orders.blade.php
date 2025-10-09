@extends('layouts.admin')

@section('title', 'Orders Management')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white dark:bg-[#161615] shadow-md rounded-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Orders Management</h1>
                <div class="flex space-x-3">
                    <form method="GET" class="flex space-x-3">
                        <select name="status" id="status-filter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:text-[#EDEDEC]">
                            <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>
                                All Status</option>
                            <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>
                                Pending Payment</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>Preparing
                            </option>
                            <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                        <button type="submit"
                            class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                            Filter
                        </button>
                    </form>
                    <a href="{{ route('admin.orders') }}"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition duration-300 text-sm">
                        Reset
                    </a>
                </div>
            </div>

            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <form method="GET">
                        @if (request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        <input type="text" name="search" id="order-search"
                            class="block w-full p-4 pl-10 text-sm text-[#1b1b18] border border-gray-300 rounded-lg bg-[#FDFDFC] focus:ring-[#f53003] focus:border-[#f53003] dark:bg-[#1E1E1C] dark:border-[#3E3E3A] dark:placeholder-[#A1A09A] dark:text-[#EDEDEC] dark:focus:ring-[#f53003] dark:focus:border-[#f53003]"
                            placeholder="Search orders..." value="{{ request('search') ?? '' }}">
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            {{-- ID --}}
                            <th
                                class="px-3 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                ID</th>
                            {{-- Customer --}}
                            <th
                                class="px-3 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                Customer</th>
                            {{-- Items --}}
                            <th
                                class="px-3 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                Items</th>
                            {{-- Table --}}
                            <th
                                class="px-3 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                Table</th>
                            {{-- Total --}}
                            <th
                                class="px-3 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                Total</th>
                            {{-- Status (min-w-32) --}}
                            <th
                                class="px-3 py-3 text-left text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider min-w-32">
                                Status</th>
                            {{-- Date (Text-right) --}}
                            <th
                                class="px-3 py-3 text-right text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                Date</th>
                            {{-- ACT. (Text-center) --}}
                            <th
                                class="px-3 py-3 text-center text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC] uppercase tracking-wider">
                                ACT.</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($orders as $order)
                            <tr>
                                <td
                                    class="px-3 py-3 whitespace-nowrap text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                    {{ $order->order_number }}</td>

                                {{-- CUSTOMER: Max width dan truncate --}}
                                <td class="px-3 py-3 max-w-20 truncate">
                                    <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] whitespace-nowrap">
                                        {{ $order->customer_name }}
                                    </div>
                                </td>

                                {{-- ITEMS: Kepadatan Maksimal (text-xs, leading-none, tanpa bullet) --}}
                                <td class="px-3 py-3 text-xs text-[#706f6c] dark:text-[#A1A09A]">
                                    <div class="space-y-0 leading-none">
                                        @forelse($order->orderItems as $item)
                                            <div class="leading-none">
                                                {{ $item->name }} ({{ $item->quantity }}x)
                                            </div>
                                        @empty
                                            <div class="leading-none">No items</div>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-3 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                    {{ $order->table_number }}</td>
                                <td
                                    class="px-3 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}</td>

                                {{-- STATUS: min-w-32 --}}
                                <td class="px-3 py-3 whitespace-nowrap min-w-32">
                                    <select
                                        class="status-update px-2 py-1 text-xs font-semibold rounded-full 
                                        @php
                                            $statusColors = [
                                                'pending_payment' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100',
                                                'processing' => 'bg-blue-200 text-blue-900 dark:bg-blue-800 dark:text-blue-100',
                                                'preparing' => 'bg-purple-200 text-purple-900 dark:bg-purple-800 dark:text-purple-100',
                                                'ready' => 'bg-orange-100 text-orange-800 dark:bg-amber-700 dark:text-amber-50',
                                                'completed' => 'bg-green-200 text-green-900 dark:bg-green-800 dark:text-green-100',
                                                'cancelled' => 'bg-red-200 text-red-900 dark:bg-red-700 dark:text-red-50',
                                            ];
                                            echo $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                                        @endphp
                                        w-full border border-gray-300 dark:border-[#3E3E3A]"
                                        data-order-number="{{ $order->order_number }}">
                                        <option value="pending_payment"
                                            {{ $order->status === 'pending_payment' ? 'selected' : '' }}>Pending Payment
                                        </option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                                            Processing</option>
                                        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>
                                            Preparing</option>
                                        <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready
                                        </option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </td>

                                {{-- DATE: Format 2 baris (H:i dan DD/MM/YYYY) dan rata kanan --}}
                                <td
                                    class="px-3 py-3 whitespace-nowrap text-sm text-right text-[#706f6c] dark:text-[#A1A09A]">
                                    <div class="font-semibold text-right text-[#1b1b18] dark:text-[#EDEDEC] text-sm">
                                        {{ $order->created_at->format('H:i') }}</div>
                                    <div class="text-xs text-right">{{ $order->created_at->format('d/m/Y') }}</div>
                                </td>

                                {{-- ACTION: Text-center --}}
                                <td class="px-3 py-3 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="#" class="text-[#f53003] hover:text-[#d92902] view-order"
                                        data-order-id="{{ $order->order_number }}">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-3 py-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }}
                    results
                </div>
                <div class="flex space-x-2">
                    @if ($orders->onFirstPage())
                        <span
                            class="px-3 py-1 rounded-md bg-gray-200 dark:bg-[#3E3E3A] text-sm text-[#706f6c] dark:text-[#A1A09A] cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}"
                            class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">Previous</a>
                    @endif

                    @foreach (range(1, $orders->lastPage()) as $page)
                        @if ($page == $orders->currentPage())
                            <span class="px-3 py-1 rounded-md bg-[#f53003] text-white text-sm">{{ $page }}</span>
                        @elseif(
                            $page == 1 ||
                                $page == $orders->lastPage() ||
                                ($page >= $orders->currentPage() - 1 && $page <= $orders->currentPage() + 1))
                            <a href="{{ $orders->url($page) }}"
                                class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">{{ $page }}</a>
                        @elseif($page == 2 && $orders->currentPage() > 3)
                            <span
                                class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC]">...</span>
                        @elseif($page == $orders->lastPage() - 1 && $orders->currentPage() < $orders->lastPage() - 2)
                            <span
                                class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC]">...</span>
                        @endif
                    @endforeach

                    @if ($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}"
                            class="px-3 py-1 rounded-md bg-white dark:bg-[#1E1E1C] border border-gray-300 dark:border-[#3E3E3A] text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-gray-50 dark:hover:bg-gray-700">Next</a>
                    @else
                        <span
                            class="px-3 py-1 rounded-md bg-gray-200 dark:bg-[#3E3E3A] text-sm text-[#706f6c] dark:text-[#A1A09A] cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="order-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75" id="modal-backdrop"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white dark:bg-[#161615] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-[#161615] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-[#1b1b18] dark:text-[#EDEDEC]" id="modal-title">
                                Order Details
                            </h3>
                            <div class="mt-4" id="modal-content">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-[#1E1E1C] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f53003] text-base font-medium text-white hover:bg-[#d92902] sm:ml-3 sm:w-auto sm:text-sm"
                        id="modal-close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Caching selector for CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]') ?
                document.querySelector('meta[name="csrf-token"]').getAttribute('content') :
                '';

            // --- Status update functionality ---
            const statusSelects = document.querySelectorAll('.status-update');
            statusSelects.forEach(select => {
                // Terapkan class Dark Mode default pada semua select saat DOMContentLoaded
                select.classList.add('dark:bg-[#1E1E1C]', 'dark:text-[#EDEDEC]', 'dark:border-[#3E3E3A]');

                select.addEventListener('change', function() {
                    const orderNumber = this.getAttribute('data-order-number');
                    const newStatus = this.value;

                    // Show loading state
                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<option value="">Updating...</option>';
                    this.disabled = true;

                    // Send AJAX request to update status
                    fetch(`{{ route('admin.orders.update-status', ['order_number' => 0]) }}`
                            .replace(
                                '0', orderNumber), {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: JSON.stringify({
                                    status: newStatus
                                })
                            })
                        .then(response => response.json())
                        .then(data => {
                            this.disabled = false;

                            if (data.success) {
                                // Update status badge with appropriate color
                                let bgColor = 'bg-gray-100 text-gray-800';
                                switch (newStatus) {
                                    case 'pending_payment':
                                        bgColor = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'processing':
                                        bgColor = 'bg-blue-200 text-blue-900';
                                        break;
                                    case 'preparing':
                                        bgColor = 'bg-purple-200 text-purple-900';
                                        break;
                                    case 'ready':
                                        bgColor = 'bg-orange-100 text-orange-800';
                                        break;
                                    case 'completed':
                                        bgColor = 'bg-green-200 text-green-900';
                                        break;
                                    case 'cancelled':
                                        bgColor = 'bg-red-200 text-red-900';
                                        break;
                                }

                                // Update the select to show the new status with the right color
                                let darkModeClasses = 'dark:bg-[#1E1E1C] dark:text-[#EDEDEC] dark:border-[#3E3E3A]';
                                switch (newStatus) {
                                    case 'pending_payment':
                                        darkModeClasses = 'dark:bg-yellow-600 dark:text-yellow-100 dark:border-[#3E3E3A]'; // More yellow like warning light
                                        break;
                                    case 'processing':
                                        darkModeClasses = 'dark:bg-blue-800 dark:text-blue-100 dark:border-[#3E3E3A]';
                                        break;
                                    case 'preparing':
                                        darkModeClasses = 'dark:bg-purple-800 dark:text-purple-100 dark:border-[#3E3E3A]';
                                        break;
                                    case 'ready':
                                        darkModeClasses = 'dark:bg-amber-700 dark:text-amber-50 dark:border-[#3E3E3A]'; // Amber dark - more distinct
                                        break;
                                    case 'completed':
                                        darkModeClasses = 'dark:bg-green-800 dark:text-green-100 dark:border-[#3E3E3A]';
                                        break;
                                    case 'cancelled':
                                        darkModeClasses = 'dark:bg-red-700 dark:text-red-50 dark:border-[#3E3E3A]'; // More red/darker red
                                        break;
                                }
                                
                                this.className = `status-update px-2 py-1 text-xs font-semibold rounded-full ${bgColor} w-full border border-gray-300 ${darkModeClasses}`;
                                this.innerHTML = `
                                    <option value="pending_payment" ${newStatus === 'pending_payment' ? 'selected' : ''}>Pending Payment</option>
                                    <option value="processing" ${newStatus === 'processing' ? 'selected' : ''}>Processing</option>
                                    <option value="preparing" ${newStatus === 'preparing' ? 'selected' : ''}>Preparing</option>
                                    <option value="ready" ${newStatus === 'ready' ? 'selected' : ''}>Ready</option>
                                    <option value="completed" ${newStatus === 'completed' ? 'selected' : ''}>Completed</option>
                                    <option value="cancelled" ${newStatus === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                `;
                                alert('Status updated successfully!');
                            } else {
                                // Restore original value and show error
                                this.innerHTML = originalHtml;
                                alert('Failed to update status: ' + (data.message ||
                                    'Unknown error'));
                            }
                        })
                        .catch(error => {
                            // Restore original value and show error
                            this.innerHTML = originalHtml;
                            this.disabled = false;
                            console.error('Error:', error);
                            alert('An error occurred while updating the status.');
                        });
                });
            });

            // --- View order modal functionality ---
            const viewButtons = document.querySelectorAll('.view-order');
            const modal = document.getElementById('order-modal');
            const modalBackdrop = document.getElementById('modal-backdrop');
            const modalClose = document.getElementById('modal-close');
            const modalContent = document.getElementById('modal-content');

            viewButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const orderNumber = this.getAttribute('data-order-id');

                    // Tampilkan loading state
                    modalContent.innerHTML =
                        '<p class="text-center text-[#706f6c] dark:text-[#A1A09A]">Loading details...</p>';
                    modal.classList.remove('hidden');

                    // Fetch order details via AJAX
                    fetch(`{{ route('admin.api.orders.show', ['order_number' => 0]) }}`.replace(
                            '0', orderNumber))
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const order = data.order;

                                let itemsHtml = '';
                                if (order.order_items && order.order_items.length > 0) {
                                    order.order_items.forEach(item => {
                                        // Hitung dan format total per item
                                        const itemTotal = (item.quantity * item.price)
                                            .toLocaleString('id-ID');
                                        itemsHtml +=
                                            `<li class="py-1 text-[#1b1b18] dark:text-[#EDEDEC]">${item.quantity}x ${item.name} - Rp ${itemTotal}</li>`;
                                    });
                                } else {
                                    itemsHtml =
                                        '<li class="py-1 text-[#1b1b18] dark:text-[#EDEDEC]">No items</li>';
                                }

                                // Format tanggal di modal: 7/10/2025, 04.40.12
                                const dateObj = new Date(order.created_at);
                                const formattedDate = dateObj.toLocaleDateString('id-ID', {
                                    day: 'numeric',
                                    month: 'numeric',
                                    year: 'numeric'
                                });
                                const formattedTime = dateObj.toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    hour12: false
                                }).replace(/:/g, '.');

                                const finalDateTime = `${formattedDate}, ${formattedTime}`;


                                modalContent.innerHTML = `
                                    <div class="mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">
                                        <h4 class="font-bold">Order #${order.order_number}</h4>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Customer: ${order.customer_name}</p>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Table: ${order.table_number}</p>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Status: ${order.status.replace('_', ' ')}</p>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Payment Method: ${order.payment_method === 'qris' ? 'QRIS' : 'Cash'}</p>
                                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Date: ${finalDateTime}</p>
                                        ${order.notes ? `<p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-2">Notes: ${order.notes}</p>` : ''}
                                    </div>
                                    <div class="mb-4">
                                        <h5 class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Items:</h5>
                                        <ul class="list-disc list-inside">
                                            ${itemsHtml}
                                        </ul>
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-[#3E3E3A] pt-3 text-[#1b1b18] dark:text-[#EDEDEC]">
                                        <div class="flex justify-between py-1">
                                            <span>Subtotal:</span>
                                            <span class="font-semibold">Rp ${order.subtotal.toLocaleString('id-ID')}</span>
                                        </div>
                                        <div class="flex justify-between py-1">
                                            <span>Tax:</span>
                                            <span class="font-semibold">Rp ${order.tax.toLocaleString('id-ID')}</span>
                                        </div>
                                        <div class="flex justify-between py-1 font-bold text-lg border-t border-gray-200 dark:border-[#3E3E3A] pt-2">
                                            <span>Total:</span>
                                            <span class="text-[#f53003]">Rp ${order.total.toLocaleString('id-ID')}</span>
                                        </div>
                                    </div>
                                `;

                            } else {
                                modalContent.innerHTML =
                                    `<p class="text-center text-red-600 dark:text-red-400">Failed to load order details: ${data.message || 'Unknown Error'}</p>`;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalContent.innerHTML =
                                '<p class="text-center text-red-600 dark:text-red-400">An error occurred while loading order details.</p>';
                        });
                });
            });

            // Modal close functionality
            modalClose.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            modalBackdrop.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>
@endsection
