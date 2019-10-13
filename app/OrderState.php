<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{
    protected $guarded = [];
    protected $with = ["user"];

    public function order(){
        return $this->belongsTo("App\Order");
    }
    public function state(){
        return $this->belongsTo("App\OrderPossibleState", "state_id");
    }
    public function user() {
        return $this->belongsToMany("App\User");
    }
}
