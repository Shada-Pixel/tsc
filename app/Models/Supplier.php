<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'logo',
        'id_number',
        'laisence',
        'initial_payable',
        'initial_receivable',
        'status',
    ];
}
