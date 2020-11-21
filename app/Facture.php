<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
