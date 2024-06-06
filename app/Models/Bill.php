<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'userId',
        'productId',
        'quantityPurchased',
        'DatePurchase',
        'Purchased',
    ];
    protected $primaryKey = 'billId';
    public $timestamps = false;
    public function products()
    {
        return $this->hasOne(Product::class, 'productId', 'productId');
    }
}
