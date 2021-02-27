<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $hidden=["created_at",'updated_at'];
    public function facture()
    {
        return $this->hasMany(Facture::class);
    }

    public function fuel()
    {
        return $this->hasMany(Fuel::class);
    }
}
