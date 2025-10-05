<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    /**
     * Display the menu page with table information and menu items from database.
     */
    public function index(Request $request)
    {
        // Check if customer is authenticated
        if (!Session::get('customer_authenticated')) {
            return redirect()->route('customer.table')->with('error', 'Silakan pilih nomor meja terlebih dahulu.');
        }

        // Fetch all categories from database
        $categories = Category::select('id', 'name', 'slug', 'is_active')
            ->where('is_active', true)
            ->get();

        // Fetch menu items with category relationship, including only active items
        $menuItems = Menu::select('id', 'name', 'price', 'status', 'image', 'category_id')
            ->with([
                'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->get();

        $tableNumber = Session::get('customer_table_number');
        $customerName = Session::get('customer_name', 'Customer');

        return view('customer.menu', compact('tableNumber', 'customerName', 'categories', 'menuItems'));
    }
}