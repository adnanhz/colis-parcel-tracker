<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany("App\Product", "order_products");
    }
    public function userPlaced(){
        return $this->belongsTo("App\User");
    }
    public function states() {
        return $this->belongsToMany("App\OrderPossibleState", "order_states", "user_id", "state_id");
    }
    
}
