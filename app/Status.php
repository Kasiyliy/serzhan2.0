<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public const IN_STORAGE_ID = 1;
    public const NOT_IN_STORAGE = 2;
    public const HIDDEN_ID = 3;

    protected $fillable = ['name'];
    protected $table = 'statuses';

}
