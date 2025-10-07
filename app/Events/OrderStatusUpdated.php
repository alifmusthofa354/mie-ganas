<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order->load('orderItems');
        
        Log::info('OrderStatusUpdated event created: ' . $order->id . ', status: ' . $order->status);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Gunakan Channel publik dengan nama unik untuk keamanan
        // Karena token pelanggan dan nomor order unik, maka ini cukup aman
        Log::info('Broadcasting status update for order: ' . $this->order->id . ', channel: customer.' . $this->order->customer_token . '.order.' . $this->order->order_number);
        
        return [
            new Channel('customer.' . $this->order->customer_token . '.order.' . $this->order->order_number),
        ];
    }
    
    public function broadcastAs(): string
    {
        Log::info('Broadcasting status update as: ' . $this->order->id);
        return 'order.status.updated';
    }
    
    public function broadcastWith(): array
    {
        Log::info('broadcastWith called for order: ' . $this->order->id . ', status: ' . $this->order->status);
        return [
            'order' => $this->order,
            'status' => $this->order->status,
            'status_label' => ucfirst(str_replace('_', ' ', $this->order->status)),
            'message' => 'Status pesanan #' . $this->order->order_number . ' telah diperbarui menjadi ' . ucfirst(str_replace('_', ' ', $this->order->status)),
        ];
    }
}