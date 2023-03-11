<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'receipt_number',
        'transaction_amount',
        'transaction_number',
        'transaction_date',
        'receiver_name',
        'receiver_account_number',
        'purpose'
    ];
}