<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productcart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    protected $table = 'productcarts';
}
