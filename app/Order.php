<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $with = ["userPlaced", "states", "products"];
    protected $appends = ["currentState"];

    public function products(){
        return $this->belongsToMany("App\Product", "order_products");
    }
    public function userPlaced(){
        return $this->belongsTo("App\User");
    }
    public function states() {
        return $this->belongsToMany("App\OrderPossibleState", "order_states", "order_id", "state_id");
    }
    public function getCurrentStateAttribute() {
        return $this->states()->orderBy("order_states.created_at", "desc")->first();
    }
}
