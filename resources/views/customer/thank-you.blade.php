@extends('layouts.customer')

@section('title', 'Terima Kasih - Mie Ganas')

@section('content')
    <!-- Hidden input fields to store customer session data -->
    <input type="hidden" id="customer_table_number" value="{{ session('customer_table_number', 'N/A') }}">
    <input type="hidden" id="customer_name" value="{{ session('customer_name', 'Customer') }}">
    
    <!-- Thank You Header -->
    <div class="mb-6 bg-[#f53003] text-white rounded-lg p-4 shadow">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold">Meja Anda: #{{ session('customer_table_number', 'N/A') }}</h2>
                <p class="text-sm opacity-80">Terima kasih atas pesanan Anda</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ session('customer_name', 'Customer') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Thank You Content -->
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-8">
            <div class="mb-6">
                <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <h2 class="text-2xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Pesanan Berhasil!</h2>
            <p class="text-[#706f6c] dark:text-[#A1A09A] mb-6">
                Terima kasih telah memesan di Mie Ganas. Pesanan Anda sedang kami proses dan akan segera disajikan.
            </p>
            
            <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg p-6 mb-6 text-left">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Detail Pesanan</h3>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Nomor Pesanan:</span>
                        <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">#{{ $order->order_number ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Status Pesanan:</span>
                        <span class="font-medium text-[#f53003] dark:text-[#FF4433]">{{ ucfirst(str_replace('_', ' ', $order->status ?? 'N/A')) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Total Pembayaran:</span>
                        <span class="font-medium text-[#f53003] dark:text-[#FF4433]">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Metode Pembayaran:</span>
                        <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">{{ strtoupper($order->payment_method ?? 'N/A') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-3">Perkiraan Waktu Tunggu</h3>
                <div class="text-3xl font-bold text-[#f53003] dark:text-[#FF4433]">
                    15-20 Menit
                </div>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mt-2">
                    Pesanan akan segera kami antar ke meja Anda
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('customer.menu') }}"
                   class="px-6 py-3 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 font-medium">
                    Pesan Lagi
                </a>
                <a href="{{ route('customer.order-tracking', $order->order_number ?? '') }}"
                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-[#1b1b18] rounded-lg transition duration-300 font-medium dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-[#EDEDEC]">
                    Lacak Pesanan
                </a>
            </div>
        </div>
    </div>
@endsection