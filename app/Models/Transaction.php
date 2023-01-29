<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'amount',
        'reference',
        'merchant_ref',
        'status',
        'data',
        'user_id',
        'expired',
        'qr',
        'customer_id',
        'product_code'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
