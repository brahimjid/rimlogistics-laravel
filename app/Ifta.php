<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ifta extends Model
{
    public $timestamps=false;
    protected $fillable=['driver_id','state_id','distance',	'fuel'];
}
