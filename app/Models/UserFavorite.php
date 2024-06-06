<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    protected $table = 'user_favorites';

    protected $fillable = [
        'userId', 'productId'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
