<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];
    protected $table = 'roles';

    public const ADMIN_ID = 1;
    public const VENDOR_ID = 2;
    public const SUPER_VIEWER_ID = 3;

    public function users(){
        return $this->hasMany('App\User');
    }
}
