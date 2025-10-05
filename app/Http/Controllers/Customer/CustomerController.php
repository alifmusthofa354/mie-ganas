<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
     * Handle table number selection and create customer session.
     */
    public function selectTable(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer|min:1|max:20',
        ]);

        // Store table number in session
        Session::put('customer_table_number', $request->table_number);
        
        // Generate a simple customer identifier (you could use more sophisticated methods)
        $customerName = $request->customer_name ?? 'Customer';
        Session::put('customer_name', $customerName);
        
        // Set a flag to indicate the customer is authenticated via table selection
        Session::put('customer_authenticated', true);

        // Redirect to menu page
        return redirect()->route('customer.menu');
    }

    /**
     * Display the menu page with table information.
     */
    public function menu(Request $request)
    {
        // Check if customer is authenticated
        if (!Session::get('customer_authenticated')) {
            return redirect()->route('customer.table')->with('error', 'Silakan pilih nomor meja terlebih dahulu.');
        }

        $tableNumber = Session::get('customer_table_number');
        $customerName = Session::get('customer_name', 'Customer');

        return view('customer.menu', compact('tableNumber', 'customerName'));
    }

    /**
     * Handle QR code login (for when scanning QR at table).
     */
    public function qrLogin(Request $request, $tableNumber, $sessionId = null)
    {
        // Validate table number
        if ($tableNumber < 1 || $tableNumber > 20) {
            return redirect()->route('customer.table')->with('error', 'Nomor meja tidak valid.');
        }

        // Store table number in session
        Session::put('customer_table_number', $tableNumber);
        
        // Generate a name for QR-based login
        Session::put('customer_name', 'Customer');
        
        // Set authentication flag
        Session::put('customer_authenticated', true);

        // Redirect to menu
        return redirect()->route('customer.menu');
    }

    /**
     * Logout customer and clear session.
     */
    public function logout(Request $request)
    {
        Session::forget(['customer_table_number', 'customer_name', 'customer_authenticated']);
        $request->session()->regenerate();

        return redirect()->route('customer.table')->with('success', 'Berhasil keluar.');
    }
}