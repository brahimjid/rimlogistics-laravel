<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
  protected $hidden=["updated_at"];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
