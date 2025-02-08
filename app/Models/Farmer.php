<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Farmer extends Model
{
    //
    public function products()
{
    return $this->hasMany(Product::class);
}
}


