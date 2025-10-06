@extends('layouts.customer')

@section('title', 'Riwayat Pesanan - Mie Ganas')

@section('content')
    <input type="hidden" id="customer_table_number" value="{{ session('customer_table_number', 'N/A') }}">
    <input type="hidden" id="customer_name" value="{{ session('customer_name', 'Customer') }}">

    <div class="mb-6 bg-[#f53003] text-white rounded-lg p-4 shadow">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold">Riwayat Pesanan</h2>
                <p class="text-sm opacity-80">Meja: {{ $tableNumber }} | {{ $customerName }}</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-6 border border-gray-200 dark:border-[#3E3E3A]">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC]">
                                    Pesanan #{{ $order->order_number }}
                                </h3>
                                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                    Tanggal: {{ $order->created_at->format('d M Y H:i') }} | 
                                    Meja: {{ $order->table_number }}
                                </p>
                            </div>
                            <span class="inline-block px-3 py-1 bg-[#f53003] text-white rounded-full text-sm">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <div class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">
                                <span class="font-medium">Metode Pembayaran:</span> 
                                {{ $order->payment_method === 'qris' ? 'QRIS' : 'Tunai' }}
                            </div>
                            @if($order->notes)
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                    <span class="font-medium">Catatan:</span> {{ $order->notes }}
                                </div>
                            @endif
                        </div>

                        <div class="space-y-2 mb-4 max-h-40 overflow-y-auto">
                            @foreach($order->orderItems as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ $item->quantity }}x {{ $item->name }}</span>
                                    <span class="text-[#f53003] dark:text-[#FF4433]">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-200 dark:border-[#3E3E3A] pt-3 mt-3">
                            <div class="flex justify-between text-[#1b1b18] dark:text-[#EDEDEC] font-medium mb-1">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                                <span>Pajak:</span>
                                <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold mt-2 pt-2 border-t border-gray-200 dark:border-[#3E3E3A]">
                                <span>Total:</span>
                                <span class="text-[#f53003] dark:text-[#FF4433]">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('customer.order-tracking', $order->order_number) }}"
                               class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-8 text-center">
                <div class="text-5xl mb-4">🛍️</div>
                <h3 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Belum Ada Riwayat Pesanan</h3>
                <p class="text-[#706f6c] dark:text-[#A1A09A] mb-4">
                    Pesanan Anda akan muncul di sini setelah Anda melakukan pemesanan.
                </p>
                <a href="{{ route('customer.menu') }}"
                   class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                    Buat Pesanan Baru
                </a>
            </div>
        @endif
    </div>
@endsection