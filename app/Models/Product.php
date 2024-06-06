<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'productName',
        'styleId',
        'productImage',
        'productStatus',
        'productPrice',
        'productQuantity',
        'productSoldQt',
        'productInfor',
        'productIntro',
        'productDiscount',
        'productTmName'
    ];

    protected $primaryKey = "productId";
    public $timestamps = false;
}
