<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps=false;
    protected $fillable=['name','code'];


    public static function getId($str){

        return State::where("code",$str)->orWhere('name',$str)->select('id')->first();
}
}
