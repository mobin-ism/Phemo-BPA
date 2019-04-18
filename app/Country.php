<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }
}
