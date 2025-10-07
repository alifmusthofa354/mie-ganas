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

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        // Memuat relasi item agar bisa diakses di JavaScript
        $this->order = $order->load('orderItems');

        Log::info('Order created: ' . $order->id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Gunakan PrivateChannel untuk keamanan, hanya admin yang bisa mendengarkan
        Log::info('Broadcasting order: ' . $this->order->id);
        return [
            new PrivateChannel('admin.orders'),
        ];
    }
    
    public function broadcastAs(): string
    {
        Log::info('Broadcasting as: ' . $this->order->id);
        return 'order.created';
    }
    
    public function broadcastWith(): array
    {
        Log::info('broadcastWith called with order: ' . $this->order->id);
        return [
            'order' => $this->order,
            'message' => 'New order created: #' . $this->order->id,
        ];
    }
}
