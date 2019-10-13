<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $with = ["userPlaced", "states", "products"];
    protected $appends = ["currentState"];

    public function products(){
        return $this->belongsToMany("App\Product", "order_products")->withPivot(['quantity', 'one_item_price']);
    }
    public function userPlaced(){
        return $this->belongsTo("App\User", "user_placed");
    }
    public function states() {
        return $this->belongsToMany("App\OrderPossibleState", "order_states", "order_id", "state_id")->withPivot(['created_at', 'user_id'])->orderBy('order_states.created_at', 'DESC');
    }

    public function order_states() {
        return $this->hasMany("App\OrderState");
    }

    public function getCurrentStateAttribute() {
        return $this->states()->orderBy("order_states.created_at", "desc")->first();
    }
}
