<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $fillable = [
        'productPrice', 'productName','productDesc','productQty','fileName','status','idCat'
    ];

    public $timestamps = false;
}
