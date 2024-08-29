<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\DeliveryBoy;
use Carbon\Carbon;

class AssignOrdersToDeliveryBoys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign orders to delivery boys based on their capacity and delivery duration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deliveryBoys = DeliveryBoy::whereNull('deleted_at')->get();
        $pendingOrders = Order::whereNull('deleted_at')->where('status', 'pending')->get();

        foreach ($pendingOrders as $order) {
            foreach ($deliveryBoys as $deliveryBoy) {
                $activeOrders = Order::where('delivery_boy_id', $deliveryBoy->id)
                    ->where('status', 'assigned')
                    ->where('assigned_at', '>=', Carbon::now()->subMinutes($deliveryBoy->delivery_duration_in_minutes))
                    ->count();

                if ($activeOrders < $deliveryBoy->max_orders) {
                    $order->delivery_boy_id = $deliveryBoy->id;
                    $order->status = 'assigned';
                    $order->assigned_at = Carbon::now();
                    $order->save();
                    break;
                }
            }
        }

        $this->info('Orders have been assigned to delivery boys.');
    
    }
}
