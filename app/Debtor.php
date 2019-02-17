<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $fillable = ['order_id', 'price'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
