<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Farmer extends Model
{
    //

    protected $fillable = ['user_id', 'farm_name', 'location'];

    public function user()
    {
        return $this->belongsTo(User::class);   
    }
    public function products()
{
    return $this->hasMany(Product::class);
}
}


