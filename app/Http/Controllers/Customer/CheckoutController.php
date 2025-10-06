<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page.
     */
    public function showCheckout(Request $request)
    {
        // Check if customer is authenticated
        if (!Session::get('customer_authenticated')) {
            return redirect()->route('customer.table')->with('error', 'Silakan pilih nomor meja terlebih dahulu.');
        }

        $tableNumber = Session::get('customer_table_number');
        $customerName = Session::get('customer_name', 'Customer');

        return view('customer.checkout', compact('tableNumber', 'customerName'));
    }

    /**
     * Process the order.
     */
    public function processOrder(Request $request)
    {
        // --- 1. Validasi Input Kritis dari Client ---
        $request->validate([
            'cart_data' => 'required|json', // Pastikan cart_data adalah JSON
            'name' => 'required|string|max:255',
            'payment_method' => 'required|in:qris,cash',
            'notes' => 'nullable|string|max:500',
            // untuk subtotal, tax, total Never Trust Client Input
        ]);

        // Check if customer is authenticated
        if (!Session::get('customer_authenticated')) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan pilih nomor meja terlebih dahulu.'
            ], 400);
        }

        try {
            // --- 2. Decode dan Validasi Struktur Cart Data ---
            $cartData = json_decode($request->cart_data, true);

            if (!$cartData || !is_array($cartData) || empty($cartData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Keranjang pesanan kosong atau tidak valid.'
                ], 400);
            }

            // --- 3. Hitung Ulang Total di Sisi Server ---
            $subtotal = 0;
            $orderItemsData = [];
            $taxRate = 0.11; // 11%

            // Ambil semua ID menu untuk query database tunggal (efisiensi)
            $menuIds = array_column($cartData, 'id');
            $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

            foreach ($cartData as $clientItem) {
                // Kita hanya ambil 'id' (menu_id) dan 'quantity' dari client
                $menuId = $clientItem['id'] ?? null;
                $quantity = $clientItem['quantity'] ?? 0;

                // Validasi: Pastikan item ada di database dan kuantitas valid
                if (isset($menus[$menuId]) && is_numeric($quantity) && $quantity > 0) {
                    $menu = $menus[$menuId];
                    $itemPrice = $menu->price; // Gunakan harga dari database
                    $itemTotal = $itemPrice * $quantity;

                    $subtotal += $itemTotal;

                    // Siapkan data OrderItem untuk disimpan
                    $orderItemsData[] = [
                        'menu_id' => $menu->id,
                        'name' => $menu->name, // Ambil nama dari DB
                        'price' => $itemPrice, // Ambil harga dari DB
                        'quantity' => (int) $quantity,
                        'total' => $itemTotal,
                    ];
                } else {
                    // Jika ada item di keranjang client yang tidak valid di server (misal ID salah), tolak pesanan
                    return response()->json([
                        'success' => false,
                        'message' => 'Salah satu item di keranjang tidak valid atau sudah dihapus dari menu.'
                    ], 400);
                }
            }

            // Hitung Pajak dan Total Akhir
            $tax = $subtotal * $taxRate;
            $total = $subtotal + $tax;

            // --- 4. Simpan Order dengan Nilai Hasil Perhitungan Server ---
            $order = Order::create([
                'table_number' => Session::get('customer_table_number'),
                'customer_name' => $request->name,
                'notes' => $request->notes ?? '',
                'subtotal' => $subtotal, // Menggunakan nilai yang dihitung server
                'tax' => $tax,         // Menggunakan nilai yang dihitung server
                'total' => $total,       // Menggunakan nilai yang dihitung server
                'payment_method' => $request->payment_method,
                'status' => $request->payment_method === 'cash' ? 'pending_payment' : 'processing',
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            ]);

            // --- 5. Simpan Item Order ---
            foreach ($orderItemsData as $item) {
                OrderItem::create(array_merge($item, ['order_id' => $order->id]));
            }

            // --- 6. Response Sukses ---
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil diproses.',
                'redirect_url' => route('customer.thank-you', ['order_number' => $order->order_number])
            ]);

        } catch (\Exception $e) {
            Log::error('Order processing failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Show the thank you page after order is placed.
     */
    public function thankYou($order_number)
    {
        // Check if customer is authenticated
        if (!Session::get('customer_authenticated')) {
            return redirect()->route('customer.table')->with('error', 'Silakan pilih nomor meja terlebih dahulu.');
        }

        // Find the order by order number
        $order = Order::where('order_number', $order_number)->first();

        if (!$order) {
            return redirect()->route('customer.menu')->with('error', 'Pesanan tidak ditemukan.');
        }

        $tableNumber = Session::get('customer_table_number');
        $customerName = Session::get('customer_name', 'Customer');

        return view('customer.thank-you', compact('order', 'tableNumber', 'customerName'));
    }
}