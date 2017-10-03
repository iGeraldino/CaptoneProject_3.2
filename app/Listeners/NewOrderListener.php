<?php

namespace App\Listeners;

use App\Events\NewOrders;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\AdminAcct;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Auth;

class NewOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewOrders  $event
     * @return void
     */
    public function handle(NewOrders $event)
    {
      $Admins = DB::select('CALL wonderbloomdb2.view_ServerSide_Accts()');
      //dd($event->Order->Customer_Fname);
      $msg = $event->Order->Customer_Fname.' '.$event->Order->Customer_MName.', '.$event->Order->Customer_Fname.' made an order';
      foreach($Admins as $row){
        $NewNotif = new Notification;
        $NewNotif->Reciever_ID = $row->id;
        $NewNotif->Message = $msg;
        $NewNotif->Order_ID = $event->Order->sales_order_ID;
        $NewNotif->Type = 'New_Order';
        $NewNotif->save();
      }
        //

    }
}
