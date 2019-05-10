<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','category_id','quantity','price','status_id'];
    protected $table = 'items';

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

}
