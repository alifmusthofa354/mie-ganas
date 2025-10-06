@extends('layouts.customer')

@section('title', 'Lacak Pesanan - Mie Ganas')

@section('content')
    <input type="hidden" id="customer_table_number" value="{{ session('customer_table_number', 'N/A') }}">
    <input type="hidden" id="customer_name" value="{{ session('customer_name', 'Customer') }}">

    <div class="mb-6 bg-[#f53003] text-white rounded-lg p-4 shadow">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold">Melacak Pesanan #{{ $order->order_number }}</h2>
                <p class="text-sm opacity-80">Meja: {{ $order->table_number }} | Status:
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ $order->customer_name }}
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-6">Status Pesanan</h2>

            <div class="mb-8">
                <div class="flex justify-between mb-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    <span>Menunggu Pembayaran</span>
                    <span>Proses</span>
                    <span>Siap Disajikan</span>
                    <span>Selesai</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-[#1E1E1C] rounded-full h-2.5">
                    <div class="h-2.5 rounded-full bg-[#f53003]" id="progressBar"
                        style="width: {{ $order->status === 'pending_payment' ? '25' : ($order->status === 'processing' ? '50' : ($order->status === 'preparing' ? '75' : ($order->status === 'ready' ? '90' : '100'))) }}%">
                    </div>
                </div>
            </div>

            <div class="space-y-4 mb-6">
                {{-- Status 1: Menunggu Pembayaran --}}
                <div class="flex items-start">
                    <div class="mr-4">
                        {{-- Logika: Aktif jika status BUKAN 'completed' atau 'cancelled' --}}
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ in_array($order->status, ['pending_payment', 'processing', 'preparing', 'ready', 'completed']) ? 'bg-[#f53003] text-white' : 'bg-gray-300 text-[#1b1b18]' }}">
                            @if (in_array($order->status, ['processing', 'preparing', 'ready', 'completed']))
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                1
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 pb-4">
                        <h3 class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Menunggu Pembayaran</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            Pesanan telah dibuat.
                            @if ($order->payment_method === 'qris')
                                Silakan selesaikan pembayaran via QRIS.
                            @else
                                Pembayaran akan dilakukan di kasir setelah pesanan selesai.
                            @endif
                        </p>
                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                            {{ $order->created_at ? $order->created_at->format('H:i') : '' }}
                        </p>
                    </div>
                </div>

                {{-- Status 2: Pesanan Diproses --}}
                <div class="flex items-start">
                    <div class="mr-4">
                        {{-- Logika: Aktif jika status >= 'processing' --}}
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ in_array($order->status, ['processing', 'preparing', 'ready', 'completed']) ? 'bg-[#f53003] text-white' : 'bg-gray-300 text-[#1b1b18]' }}">
                            @if (in_array($order->status, ['preparing', 'ready', 'completed']))
                                {{-- Jika sudah di 'preparing' dan seterusnya, tampilkan checkmark --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            @elseif ($order->status === 'processing')
                                {{-- Jika status TEPAT 'processing', jangan tampilkan checkmark, biarkan 2 --}}
                                2
                            @else
                                {{-- Jika status di bawah 'processing', tampilkan 2 --}}
                                2
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 pb-4">
                        <h3 class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Pesanan Diproses</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            Pesanan Anda sedang diproses oleh tim dapur kami.
                        </p>
                        @if (in_array($order->status, ['processing', 'preparing', 'ready', 'completed']))
                            {{-- Tampilkan perkiraan waktu masuk status ini --}}
                            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                                {{ $order->created_at ? $order->created_at->addMinutes(5)->format('H:i') : '' }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Status 3: Sedang Disiapkan --}}
                <div class="flex items-start">
                    <div class="mr-4">
                        {{-- Logika: Aktif jika status >= 'preparing' --}}
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ in_array($order->status, ['preparing', 'ready', 'completed']) ? 'bg-[#f53003] text-white' : 'bg-gray-300 text-[#1b1b18]' }}">
                            @if (in_array($order->status, ['ready', 'completed']))
                                {{-- Jika sudah di 'ready' dan seterusnya, tampilkan checkmark --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            @elseif ($order->status === 'preparing')
                                {{-- Jika status TEPAT 'preparing', jangan tampilkan checkmark, biarkan 3 --}}
                                3
                            @else
                                {{-- Jika status di bawah 'preparing', tampilkan 3 --}}
                                3
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 pb-4">
                        <h3 class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Sedang Disiapkan</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            Makanan Anda sedang disiapkan oleh koki kami.
                        </p>
                        @if (in_array($order->status, ['preparing', 'ready', 'completed']))
                            {{-- Tampilkan perkiraan waktu masuk status ini --}}
                            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                                {{ $order->created_at ? $order->created_at->addMinutes(10)->format('H:i') : '' }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Status 4: Siap Diantar --}}
                <div class="flex items-start">
                    <div class="mr-4">
                        {{-- Logika: Aktif jika status >= 'ready' --}}
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ in_array($order->status, ['ready', 'completed']) ? 'bg-[#f53003] text-white' : 'bg-gray-300 text-[#1b1b18]' }}">
                            @if ($order->status === 'completed')
                                {{-- Jika sudah 'completed', tampilkan checkmark --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                4
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 pb-4">
                        <h3 class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Siap Diantar</h3>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            Pesanan Anda siap dan akan segera diantarkan ke meja Anda.
                        </p>
                        @if (in_array($order->status, ['ready', 'completed']))
                            {{-- Tampilkan perkiraan waktu masuk status ini --}}
                            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                                {{ $order->created_at ? $order->created_at->addMinutes(15)->format('H:i') : '' }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-[#FDFDFC] dark:bg-[#1E1E1C] rounded-lg p-4 mb-6">
                <h3 class="text-lg font-bold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-3">
                    @foreach ($order->orderItems as $item)
                        <div class="flex justify-between">
                            <span class="text-[#1b1b18] dark:text-[#EDEDEC]">{{ $item->quantity }}x
                                {{ $item->name }}</span>
                            <span class="text-[#f53003] dark:text-[#FF4433]">Rp
                                {{ number_format($item->total, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 dark:border-[#3E3E3A] pt-3 mt-3">
                    <div class="flex justify-between mb-1">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Subtotal:</span>
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Rp
                            {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Pajak (11%):</span>
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Rp
                            {{ number_format($order->tax, 0, ',', '.') }}</span>
                    </div>
                    <div
                        class="flex justify-between text-lg font-bold mt-2 pt-2 border-t border-gray-200 dark:border-[#3E3E3A]">
                        <span class="text-[#1b1b18] dark:text-[#EDEDEC]">Total:</span>
                        <span class="text-[#f53003] dark:text-[#FF4433]">Rp
                            {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('customer.menu') }}"
                class="px-4 py-2 bg-[#f53003] hover:bg-[#d92902] text-white rounded-lg transition duration-300 text-sm">
                Kembali ke Menu
            </a>
        </div>
    </div>
@endsection
