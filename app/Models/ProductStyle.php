<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStyle extends Model
{
    protected $table = 'product_style';
    protected $primaryKey = 'styleId';


    protected $fillable = [
        'styleId',
        'styleName',
    ];
}
