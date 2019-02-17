<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $fillable = ['order_items_id', 'quantity'];

    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
}
