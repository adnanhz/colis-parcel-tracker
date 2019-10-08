<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPossibleState extends Model
{
    protected $guarded = [];

    public function orders() {
        return $this->belongsToMany("App\Order", "order_states", "state_id", "order_id");
    }

    public function ordersWithThisStateAsCurrent(){
        $orders = [];   
        foreach($this->orders as $order) {
            if($order->currentState->id == $this->id) {
                $orders[] = $order;
            }
        }
        return $orders;
    }
}
