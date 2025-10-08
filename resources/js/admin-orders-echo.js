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
            ${orderTotal.replace('IDR', 'Rp')}
        </td>
        <td class="px-3 py-3 whitespace-nowrap min-w-32">
            <select
                class="status-update px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 w-full border border-gray-300 dark:bg-[#1E1E1C] dark:text-[#EDEDEC] dark:border-[#3E3E3A]"
                data-order-number="${order.order_number}">
                <option value="pending_payment" selected>Pending Payment</option>
                <option value="processing">Processing</option>
                <option value="preparing">Preparing</option>
                <option value="ready">Ready</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
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
        // Anda harus memanggil kembali logic AJAX status update yang sudah ada di atas
        // Ini adalah placeholder, pastikan logic AJAX dari kode sebelumnya dipindahkan ke fungsi ini
        newSelect.addEventListener('change', function() {
            // ... logic AJAX status update ...
            console.log('Status change detected on new row:', this.value);
        });
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
                // Jika Anda memiliki logika JS untuk status select, Anda perlu menginisialisasi ulang di sini
                attachStatusUpdateListeners(tableBody.querySelector('tr'));
            }
        })
        .error((error) => {
            console.error("Authentication error on private channel:", error);
        });
} else {
    console.error("Laravel Echo is not defined. Ensure app.js is loaded correctly.");
}