<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Farmer;

class Product extends Model
{
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
