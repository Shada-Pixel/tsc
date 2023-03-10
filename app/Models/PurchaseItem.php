<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'total_weight',
        'unit_price',
        'total_paid',
        'delivery_point'
    ];

    protected $with = ['product'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}