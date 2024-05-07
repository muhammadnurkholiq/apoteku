<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'address',
        'city',
        'post_code',
        'phone_number',
        'notes',
        'total_amount',
        'is_paid',
        'proof'
    ];
}
