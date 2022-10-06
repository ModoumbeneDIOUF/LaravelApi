<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'productPrice', 'productName','productDesc','productQty','fileName'
    ];
    public $timestamps = false;
}
