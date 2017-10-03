<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrders extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $Order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($OrderDetails)
    {
        //
        $this->Order = $OrderDetails;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */

    public function broadcastOn()
    {
        return ['OrderChannel'];
    }


    public function broadcastAs()
    {
      return 'private-NewOrders';
    }
}
