// FUNGSI UTILITY: untuk mengkonversi objek order dari event menjadi baris HTML tabel
function createOrderRowHtml(order) {

    const orderTotal = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(order.total);

    // Format Waktu dan Tanggal (sesuai format 2 baris yang Anda inginkan)
    const dateObj = new Date(order.created_at);
    const formattedTime = dateObj.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit'
    });
    const formattedDate = dateObj.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });

    // Membuat item list yang ringkas
    let itemsHtml = order.order_items.map(item =>
        `<div class="leading-none">${item.name} (${item.quantity}x)</div>`
    ).join('');

    return `
    <tr>
        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-[#1b1918cf] dark:text-[#EDEDEC]">
            ${order.order_number}
        </td>
        <td class="px-3 py-3 max-w-20 truncate"> 
            <div class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] whitespace-nowrap">${order.customer_name}</div>
        </td>
        <td class="px-3 py-3 text-xs text-[#706f6c] dark:text-[#A1A09A]">
            <div class="space-y-0 leading-none">${itemsHtml}</div>
        </td>
        <td class="px-3 py-3 whitespace-nowrap text-sm text-[#706f6c] dark:text-[#A1A09A]">
            ${order.table_number}
        </td>
        <td class="px-3 py-3 whitespace-nowrap text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
        ${formatToCurrency(order.total, 'IDR', 'id-ID')}
        </td>
        <td class="px-3 py-3 whitespace-nowrap min-w-32">
            <select
                class="status-update px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 w-full border border-gray-300 dark:bg-[#1E1E1C] dark:text-[#EDEDEC] dark:border-[#3E3E3A]"
                data-order-number="${order.order_number}">
                <option value="pending_payment"${order.status === 'pending_payment' ? ' selected' : ''}>Pending Payment</option>
                <option value="processing"${order.status === 'processing' ? ' selected' : ''}>Processing</option>
                <option value="preparing"${order.status === 'preparing' ? ' selected' : ''}>Preparing</option>
                <option value="ready"${order.status === 'ready' ? ' selected' : ''}>Ready</option>
                <option value="completed"${order.status === 'completed' ? ' selected' : ''}>Completed</option>
                <option value="cancelled"${order.status === 'cancelled' ? ' selected' : ''}>Cancelled</option>
            </select>
        </td>
        <td class="px-3 py-3 whitespace-nowrap text-sm text-right text-[#706f6c] dark:text-[#A1A09A]">
            <div class="font-semibold text-right text-[#1b1b18] dark:text-[#EDEDEC] text-sm">${formattedTime}</div>
            <div class="text-xs text-right">${formattedDate}</div>
        </td>
        <td class="px-3 py-3 whitespace-nowrap text-center text-sm font-medium">
            <a href="#" class="text-[#f53003] hover:text-[#d92902] view-order" data-order-id="${order.order_number}">View</a>
        </td>
    </tr>
`;
}

// FUNGSI UTILITY: Menginisialisasi listener status update untuk elemen baru
function attachStatusUpdateListeners(newRowElement) {
    const newSelect = newRowElement.querySelector('.status-update');
    if (newSelect) {
        // Simpan status asli sebelum perubahan
        newSelect.setAttribute('data-original-status', newSelect.value);
        
        newSelect.addEventListener('change', function() {
            const orderNumber = this.getAttribute('data-order-number');
            const newStatus = this.value;
            
            // Update status asli untuk digunakan jika terjadi error
            this.setAttribute('data-original-status', this.value);
            
            // Kirim AJAX request untuk update status
            fetch(`/admin/orders/${orderNumber}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update warna background select sesuai status
                    updateStatusSelectStyle(newSelect, newStatus);
                    console.log('Status updated successfully:', data.message);
                } else {
                    console.error('Failed to update status:', data.message);
                    // Kembalikan status sebelumnya jika gagal
                    this.value = this.getAttribute('data-original-status');
                    updateStatusSelectStyle(newSelect, this.getAttribute('data-original-status'));
                }
            })
            .catch(error => {
                console.error('Error updating status:', error);
                // Kembalikan status sebelumnya jika error
                this.value = this.getAttribute('data-original-status');
                updateStatusSelectStyle(newSelect, this.getAttribute('data-original-status'));
            });
        });
    }
    
    // Tambahkan event listener untuk view-order link
    const viewLink = newRowElement.querySelector('.view-order');
    if (viewLink) {
        viewLink.addEventListener('click', function(e) {
            e.preventDefault();
            const orderNumber = this.getAttribute('data-order-id');
            
            // Ambil elemen modal
            const modal = document.getElementById('order-modal');
            const modalBackdrop = document.getElementById('modal-backdrop');
            const modalContent = document.getElementById('modal-content');

            // Tampilkan loading state
            if (modalContent) {
                modalContent.innerHTML = 
                    '<p class="text-center text-[#706f6c] dark:text-[#A1A09A]">Loading details...</p>';
            }
            
            // Tampilkan modal
            if (modal) {
                modal.classList.remove('hidden');
            }

            // Fetch order details via AJAX
            fetch(`/admin/api/orders/${orderNumber}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const order = data.order;

                        let modalItemsHtml = '';
                        if (order.order_items && order.order_items.length > 0) {
                            order.order_items.forEach(item => {
                                // Hitung dan format total per item
                                const itemTotal = (item.quantity * item.price)
                                    .toLocaleString('id-ID');
                                modalItemsHtml +=
                                    `<li class="py-1 text-[#1b1b18] dark:text-[#EDEDEC]">${item.quantity}x ${item.name} - Rp ${itemTotal}</li>`;
                            });
                        } else {
                            modalItemsHtml =
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
                        });

                        // Format tanggal di modal: 7/10/2025, 04.40.12
                        const modalDateObj = new Date(order.created_at);
                        const modalFormattedDate = modalDateObj.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'numeric',
                            year: 'numeric'
                        });
                        const modalFormattedTime = modalDateObj.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: false
                        }).replace(/:/g, '.');
                        
                        const finalDateTime = `${modalFormattedDate}, ${modalFormattedTime}`;

                        // Format modal content to match original implementation
                        const modalContentHtml = `
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
                                    ${modalItemsHtml}
                                </ul>
                            </div>
                            <div class="border-t border-gray-200 dark:border-[#3E3E3A] pt-3 text-[#1b1b18] dark:text-[#EDEDEC]">
                                <div class="flex justify-between py-1">
                                    <span>Subtotal:</span>
                                    <span class="font-semibold">Rp ${parseFloat(order.subtotal).toLocaleString('id-ID')}</span>
                                </div>
                                <div class="flex justify-between py-1">
                                    <span>Tax:</span>
                                    <span class="font-semibold">Rp ${parseFloat(order.tax).toLocaleString('id-ID')}</span>
                                </div>
                                <div class="flex justify-between py-1 font-bold text-lg border-t border-gray-200 dark:border-[#3E3E3A] pt-2">
                                    <span>Total:</span>
                                    <span class="text-[#f53003]">Rp ${parseFloat(order.total).toLocaleString('id-ID')}</span>
                                </div>
                            </div>
                        `;
                        
                        // Isi konten modal
                        if (modalContent) {
                            modalContent.innerHTML = modalContentHtml;
                        }
                    } else {
                        if (modalContent) {
                            modalContent.innerHTML = 
                                '<p class="text-center text-red-500">Error loading order details</p>';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching order details:', error);
                    if (modalContent) {
                        modalContent.innerHTML = 
                            '<p class="text-center text-red-500">Error loading order details</p>';
                    }
                });
        });
    }
}

// Fungsi untuk memperbarui gaya select sesuai status
function updateStatusSelectStyle(selectElement, status) {
    // Hapus kelas-kelas warna sebelumnya
    selectElement.classList.remove(
        'bg-yellow-100', 'text-yellow-800', 
        'bg-green-100', 'text-green-800',
        'bg-blue-100', 'text-blue-800',
        'bg-purple-100', 'text-purple-800',
        'bg-red-100', 'text-red-800',
        'bg-gray-100', 'text-gray-800'
    );
    
    // Tambahkan kelas warna sesuai status
    switch(status) {
        case 'pending_payment':
            selectElement.classList.add('bg-yellow-100', 'text-yellow-800');
            break;
        case 'processing':
            selectElement.classList.add('bg-blue-100', 'text-blue-800');
            break;
        case 'preparing':
            selectElement.classList.add('bg-purple-100', 'text-purple-800');
            break;
        case 'ready':
            selectElement.classList.add('bg-green-100', 'text-green-800');
            break;
        case 'completed':
            selectElement.classList.add('bg-green-100', 'text-green-800');
            break;
        case 'cancelled':
            selectElement.classList.add('bg-red-100', 'text-red-800');
            break;
        default:
            selectElement.classList.add('bg-gray-100', 'text-gray-800');
    }
    
    // Update warna untuk tema gelap juga
    if (selectElement.classList.contains('dark:bg-[#1E1E1C]')) {
        selectElement.classList.remove(
            'dark:bg-[#3E3E1E]', 'dark:text-[#EDEDEC]',
            'dark:bg-[#1E3E1C]', 'dark:text-[#EDEDEC]',
            'dark:bg-[#1E1E3E]', 'dark:text-[#EDEDEC]',
            'dark:bg-[#3E1E3E]', 'dark:text-[#EDEDEC]',
            'dark:bg-[#3E1E1E]', 'dark:text-[#EDEDEC]',
            'dark:bg-[#3E3E3E]', 'dark:text-[#EDEDEC]'
        );
        
        switch(status) {
            case 'pending_payment':
                selectElement.classList.add('dark:bg-[#3E3E1E]');
                break;
            case 'processing':
                selectElement.classList.add('dark:bg-[#1E1E3E]');
                break;
            case 'preparing':
                selectElement.classList.add('dark:bg-[#1E3E1E]');
                break;
            case 'ready':
                selectElement.classList.add('dark:bg-[#1E3E1E]');
                break;
            case 'completed':
                selectElement.classList.add('dark:bg-[#1E3E1E]');
                break;
            case 'cancelled':
                selectElement.classList.add('dark:bg-[#3E1E1E]');
                break;
            default:
                selectElement.classList.add('dark:bg-[#3E3E3E]');
        }
    }
}


// Pastikan Echo sudah terinisialisasi dan terhubung sebelum mendengarkan
if (typeof window.Echo !== 'undefined') {
    // --- Implementasi Real-time Order Update menggunakan Reverb ---
    window.Echo.private('admin.orders')
        .listen('.order.created', (e) => {
            console.log('New Order Received:', e.order);

            // 1. Tampilkan notifikasi
            alert(
                `Pesanan Baru: Order #${e.order.order_number} dari ${e.order.customer_name} telah masuk!`
                );

            // 2. Tambahkan baris baru ke tabel
            const newRow = createOrderRowHtml(e.order);
            const tableBody = document.querySelector(
                '.divide-y.divide-gray-200'); // Selector ke tbody

            // Tambahkan order baru di bagian paling atas tabel
            if (tableBody) {
                tableBody.insertAdjacentHTML('afterbegin', newRow);
                
                // Ambil elemen baris baru yang ditambahkan (baris pertama)
                const firstRow = tableBody.querySelector('tr:first-child');
                
                // Inisialisasi listener untuk elemen baru
                if (firstRow) {
                    attachStatusUpdateListeners(firstRow);
                }
            }
        })
        .error((error) => {
            console.error("Authentication error on private channel:", error);
        });
} else {
    console.error("Laravel Echo is not defined. Ensure app.js is loaded correctly.");
}

//
// Fungsi untuk mengubah angka menjadi format mata uang
//
function formatToCurrency(number, currencyCode, locale) {
  // Membuat objek formatter
  const formatter = new Intl.NumberFormat(locale, {
    style: 'currency',
    currency: currencyCode,
    minimumFractionDigits: 0, // Mengatur agar tidak ada angka di belakang desimal (koma)
    maximumFractionDigits: 0,
  });

  // Mengembalikan angka yang sudah diformat
  return formatter.format(number);
}