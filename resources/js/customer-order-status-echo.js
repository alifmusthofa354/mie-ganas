// FUNGSI UTILITY: Update UI saat status pesanan berubah
function updateOrderStatusUI(newStatus, statusLabel) {
    // Update status di header tracking page
    const statusHeader = document.querySelector('h2.text-lg.font-bold');
    if (statusHeader && statusHeader.textContent.includes('Melacak Pesanan')) {
        // Update status di header tracking page
        const orderNumber = statusHeader.textContent.match(/Melacak Pesanan #([A-Z0-9-]+)/)[1];
        statusHeader.innerHTML = `Melacak Pesanan #${orderNumber}`;
        
        const statusElement = statusHeader.nextElementSibling; // p element
        if (statusElement) {
            const tableNumber = statusElement.textContent.match(/Meja: (\d+)/)[1];
            statusElement.innerHTML = `Meja: ${tableNumber} | Status: ${statusLabel}`;
        }
    }

    // Update progress bar
    const progressBar = document.getElementById('progressBar');
    if (progressBar) {
        let progressPercentage;
        switch(newStatus) {
            case 'pending_payment':
                progressPercentage = '25';
                break;
            case 'processing':
                progressPercentage = '50';
                break;
            case 'preparing':
                progressPercentage = '75';
                break;
            case 'ready':
                progressPercentage = '90';
                break;
            case 'completed':
                progressPercentage = '100';
                break;
            default:
                progressPercentage = '25';
        }
        progressBar.style.width = `${progressPercentage}%`;
    }

    // Update status steps
    updateStatusSteps(newStatus);

    // Update status di thank you page atau order tracking page jika ada
    // Coba update berdasarkan teks konten yang mengandung 'Status:'
    const allElements = document.querySelectorAll('span, div, p');
    let statusUpdated = false;
    
    for (let element of allElements) {
        if (element.textContent && element.textContent.includes('Status:')) {
            element.textContent = element.textContent.replace(/Status:.*$/, `Status: ${statusLabel}`);
            statusUpdated = true;
            break; // Hentikan setelah menemukan dan memperbarui satu elemen
        }
    }
    
    // Jika tidak menemukan elemen dengan 'Status:' text, coba update elemen berdasarkan kelas
    if (!statusUpdated) {
        const statusElements = document.querySelectorAll('span.font-medium');
        for (let element of statusElements) {
            // Cek apakah elemen ini kemungkinan adalah status elemen berdasarkan teksnya
            const currentText = element.textContent.trim();
            if (currentText && !currentText.includes('#') && !currentText.includes('Rp') && !currentText.includes('x')) {
                // Ini mungkin elemen status, update teksnya
                element.textContent = statusLabel;
                break;
            }
        }
    }
    
    // Update hidden status field jika ada
    const currentStatusInput = document.getElementById('current_status');
    if (currentStatusInput) {
        currentStatusInput.value = newStatus;
    }
}

function updateStatusSteps(currentStatus) {
    const statusClasses = {
        'pending_payment': 1,
        'processing': 2,
        'preparing': 3,
        'ready': 4,
        'completed': 4
    };
    
    const steps = document.querySelectorAll('.flex.items-start');
    steps.forEach((step, index) => {
        const stepNumber = index + 1;
        const circle = step.querySelector('div.w-8.h-8.rounded-full');
        const checkIcon = step.querySelector('svg');
        
        if (circle) {
            if (stepNumber <= statusClasses[currentStatus]) {
                // Step sudah terlewati - ganti dengan kelas Tailwind untuk warna merah
                // Hapus kelas lama dan tambahkan kelas baru
                circle.className = circle.className.replace('bg-gray-300', '').replace('text-[#1b1b18]', '').trim() + ' bg-[#f53003] text-white';
            } else {
                // Step belum terlewati - ganti dengan kelas Tailwind untuk warna default
                // Hanya ganti jika memang sekarang dalam mode aktif
                if(circle.className.includes('bg-[#f53003]')) {
                    circle.className = circle.className.replace('bg-[#f53003]', '').replace('text-white', '').trim() + ' bg-gray-300 text-[#1b1b18]';
                }
            }
            
            // Update content dalam circle
            if (stepNumber < statusClasses[currentStatus]) {
                // Sudah selesai, tampilkan checkmark
                if (stepNumber === 1 && checkIcon) {
                    if (!checkIcon.querySelector('path')) {
                        circle.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    }
                } else if (stepNumber === 2 && checkIcon) {
                    if (!checkIcon.querySelector('path')) {
                        circle.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    }
                } else if (stepNumber === 3 && checkIcon) {
                    if (!checkIcon.querySelector('path')) {
                        circle.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    }
                } else if (stepNumber === 4 && currentStatus === 'completed' && checkIcon) {
                    if (!checkIcon.querySelector('path')) {
                        circle.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    }
                }
            } else if (stepNumber === statusClasses[currentStatus] && currentStatus !== 'completed') {
                // Step sedang aktif, tampilkan nomor
                if (stepNumber === 1) {
                    circle.innerHTML = '1';
                } else if (stepNumber === 2) {
                    circle.innerHTML = '2';
                } else if (stepNumber === 3) {
                    circle.innerHTML = '3';
                } else if (stepNumber === 4) {
                    circle.innerHTML = '4';
                }
            }
        }
    });
}

// Dapatkan customer token dari halaman
function getCustomerTokenFromPage() {
    // Coba cari token dari halaman (diembed di halaman sebagai hidden input)
    const tokenInput = document.getElementById('customer_token');
    if (tokenInput && tokenInput.value) {
        return tokenInput.value;
    }
    
    // Atau bisa dari session storage atau cookie
    return localStorage.getItem('customer_token') || sessionStorage.getItem('customer_token');
}

// Dapatkan order number dari URL atau halaman
function getOrderNumberFromPage() {
    // Coba dapatkan dari URL
    const pathParts = window.location.pathname.split('/');
    const orderNumberIndex = pathParts.indexOf('order-tracking') + 1;
    if (orderNumberIndex > 0 && orderNumberIndex < pathParts.length) {
        return pathParts[orderNumberIndex];
    }
    
    // Coba cari di header
    const headerElement = document.querySelector('h2.text-lg.font-bold');
    if (headerElement && headerElement.textContent.includes('Melacak Pesanan #')) {
        const match = headerElement.textContent.match(/Melacak Pesanan #([A-Z0-9-]+)/);
        if (match) {
            return match[1];
        }
    }
    
    // Coba dari hidden input - ini yang paling andal
    const orderNumberInput = document.getElementById('order_number');
    if (orderNumberInput && orderNumberInput.value) {
        return orderNumberInput.value;
    }
    
    // Coba cari elemen dengan teks yang mengandung nomor order
    const allElements = document.querySelectorAll('span, div, p');
    for (let element of allElements) {
        const match = element.textContent.match(/ORD-[A-Z0-9]+/);
        if (match) {
            return match[0];
        }
    }
    
    return null;
}

// Pastikan Echo sudah terinisialisasi dan terhubung sebelum mendengarkan
if (typeof window.Echo !== 'undefined') {
    console.log('Echo is defined for customer status updates');
    
    // Cek apakah kita berada di halaman yang relevan (order tracking atau thank you)
    const isTrackingPage = window.location.pathname.includes('order-tracking');
    const isThankYouPage = window.location.pathname.includes('thank-you');
    
    if (isTrackingPage || isThankYouPage) {
        const customerToken = getCustomerTokenFromPage();
        const orderNumber = getOrderNumberFromPage();
        
        if (customerToken && orderNumber) {
            console.log('Listening for order status updates on channel: customer.' + customerToken + '.order.' + orderNumber);
            
            // Mendengarkan update status pesanan untuk customer tertentu
            window.Echo.channel('customer.' + customerToken + '.order.' + orderNumber)
                .listen('.order.status.updated', (e) => {
                    console.log('Order status update received:', e);
                    
                    // Tampilkan notifikasi
                    if (Notification.permission === 'granted') {
                        new Notification('Status Pesanan Diperbarui', {
                            body: e.message,
                            icon: '/favicon.ico'
                        });
                    } else {
                        alert(e.message);
                    }
                    
                    // Update UI sesuai dengan status baru
                    updateOrderStatusUI(e.status, e.status_label);
                    
                    // Jika di halaman thank you dan status berubah ke 'ready' atau 'completed', 
                    // mungkin tampilkan pesan khusus
                    if (e.status === 'ready' || e.status === 'completed') {
                        const thankYouPage = document.querySelector('h2.text-2xl.font-bold');
                        if (thankYouPage && thankYouPage.textContent.includes('Pesanan Berhasil!')) {
                            // Mungkin tambahkan elemen khusus untuk memberi tahu pelanggan
                            const readyMessage = document.createElement('div');
                            readyMessage.className = 'bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mt-4';
                            readyMessage.innerHTML = `<p><strong>Hebat!</strong> Pesanan Anda sudah ${e.status === 'ready' ? 'siap disajikan' : 'selesai'}. Tim kami akan segera mengantarnya ke meja Anda.</p>`;
                            
                            const container = document.querySelector('.max-w-2xl.mx-auto');
                            if (container) {
                                container.insertBefore(readyMessage, container.firstChild.nextSibling); // Setelah header
                            }
                        }
                    }
                });
        } else {
            console.warn("Customer token or order number not found on tracking/thank-you page. Cannot listen for status updates.");
        }
    } else {
        // Jika tidak di halaman tracking atau thank you, tidak perlu listen
        console.log("Not on order tracking or thank you page. Skipping status update listener.");
    }
} else {
    console.error("Laravel Echo is not defined. Ensure app.js is loaded correctly.");
}