<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie; // Tambahkan Cookie
use Illuminate\Support\Str; // Tambahkan Str untuk UUID

class CustomerController extends Controller
{
    /**
     * Show the table selection form.
     */
    public function showTableForm()
    {
        return view('customer.table');
    }

    /**
     * Handle table number selection and create customer session and cookie.
     */
    public function selectTable(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer|min:1|max:20',
        ]);

        // 1. Ambil atau Buat Customer Token (untuk persistensi riwayat)
        $customerToken = $request->cookie(config('customer.token_cookie_name'));

        if (!$customerToken) {
            // Buat token baru jika belum ada
            $customerToken = Str::uuid()->toString();
        }

        // 2. Simpan Customer Session Data
        Session::put('customer_table_number', $request->table_number);
        $customerName = $request->customer_name ?? '';
        Session::put('customer_name', $customerName);
        Session::put('customer_authenticated', true);

        // 3. Set Cookie Customer Token (HttpOnly & Persistent)
        Cookie::queue(
            config('customer.token_cookie_name'), // Nama cookie
            $customerToken,             // Nilai token (UUID)
            config('customer.token_cookie_expiration'),    // Kedaluwarsa (1 tahun)
            null,                       // Path (default)
            null,                       // Domain (default)
            config('app.env') === 'production', // Secure (true hanya jika HTTPS)
            config('customer.token_cookie_http_only') // HttpOnly (PENTING: Mencegah akses JS)
        );

        // Redirect to menu page
        return redirect()->route('customer.menu');
    }

    /**
     * Handle QR code login (for when scanning QR at table) and manage cookies.
     */
    public function qrLogin(Request $request, $tableNumber, $sessionId = null)
    {
        // Validate table number
        if ($tableNumber < 1 || $tableNumber > 20) {
            return redirect()->route('customer.table')->with('error', 'Nomor meja tidak valid.');
        }

        // 1. Ambil atau Buat Customer Token (untuk persistensi riwayat)
        $customerToken = $request->cookie(config('customer.token_cookie_name'));
        if (!$customerToken) {
            $customerToken = Str::uuid()->toString();
        }

        // 2. Simpan Customer Session Data
        Session::put('customer_table_number', $tableNumber);
        Session::put('customer_name', '');
        Session::put('customer_authenticated', true);

        // 3. Set Cookie Customer Token (HttpOnly & Persistent)
        Cookie::queue(
            config('customer.token_cookie_name'), // Nama cookie
            $customerToken,             // Nilai token (UUID)
            config('customer.token_cookie_expiration'),    // Kedaluwarsa (1 tahun)
            null,                       // Path (default)
            null,                       // Domain (default)
            config('app.env') === 'production', // Secure (true hanya jika HTTPS)
            config('customer.token_cookie_http_only') // HttpOnly (PENTING: Mencegah akses JS)
        );

        // Redirect to menu
        return redirect()->route('customer.menu');
    }

    /**
     * Logout customer, clear session, dan hapus cookie riwayat.
     */
    public function logout(Request $request)
    {
        Session::forget(['customer_table_number', 'customer_name', 'customer_authenticated']);
        $request->session()->regenerate();

        // Hapus cookie riwayat pelanggan
        Cookie::queue(Cookie::forget(config('customer.token_cookie_name')));

        return redirect()->route('customer.table')->with('success', 'Berhasil keluar.');
    }
}