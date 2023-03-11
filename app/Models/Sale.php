<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'client_name',
        'client_address',
        'client_phone',
        'user_id',
        'total_price',
        'total_paid',
        'total_weight',
        'payment_method',
        'bank_receipt',
        'type',
        'delivery_point'
    ];
}