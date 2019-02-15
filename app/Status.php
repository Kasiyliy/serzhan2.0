<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public const ACCEPTED_ID = 1;
    public const UNACCEPTED_ID = 2;
    public const HIDDEN_ID = 3;

    protected $fillable = ['name'];
    protected $table = 'statuses';

}
