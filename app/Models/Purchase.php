<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_number',
        'supplier_id',
        'user_id',
        'total_price',
        'total_paid',
        'delivery_point',
        'total_weight'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y , h:i A'
    ];

    protected $with = ['supplier','purchaseItems'];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}