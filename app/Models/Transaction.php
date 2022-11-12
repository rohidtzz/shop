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
        'user_id',
        'qr'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
