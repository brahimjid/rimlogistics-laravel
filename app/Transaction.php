<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps =false;

    protected $fillable=['store_location','quantity','driver_id'];
}
