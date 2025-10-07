<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Query orders with pagination, search and filtering
        $query = Order::query();
        
        // Handle search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('table_number', 'like', '%' . $request->search . '%');
            });
        }
        
        // Handle status filter
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        // Sort by created_at descending
        $query->orderBy('created_at', 'desc');
        
        $orders = $query->paginate(10)->appends(request()->query());
        
        return view('admin.orders', compact('orders'));
    }
    
    public function updateStatus(Request $request, $order_number)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,processing,preparing,ready,completed,cancelled'
        ]);
        
        $order = Order::where('order_number', $order_number)->firstOrFail();
        
        // Update the status
        $order->status = $request->status;
        
        // Set completed_at if status is completed
        if ($request->status === 'completed' && !$order->completed_at) {
            $order->completed_at = now();
        }
        
        $order->save();
        
        // Dispatch event untuk memberitahu pelanggan tentang update status
        \App\Events\OrderStatusUpdated::dispatch($order);
        
        return response()->json([
            'success' => true,
            'message' => 'Status order updated successfully',
            'order' => $order
        ]);
    }
    
    public function getOrderDetails($order_number)
    {
        $order = Order::with('orderItems')->where('order_number', $order_number)->firstOrFail();
        
        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'table_number' => $order->table_number,
                'status' => $order->status,
                'payment_method' => $order->payment_method,
                'notes' => $order->notes,
                'subtotal' => $order->subtotal,
                'tax' => $order->tax,
                'total' => $order->total,
                'created_at' => $order->created_at->toISOString(),
                'order_items' => $order->orderItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'menu_id' => $item->menu_id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'total' => $item->total
                    ];
                })->toArray()
            ]
        ]);
    }
}