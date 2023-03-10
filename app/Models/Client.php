<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'home_address',
        'com_name',
        'com_address',
        'phone',
        'email',
        'nid',
        'bank_name',
        'bank_branch_name',
        'bank_routing_number',
        'bank_account_number',
        'total_purchase',
        'amount_payable',
        'amount_receivable',
        'status'
    ];
}
