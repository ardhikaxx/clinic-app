<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id', 'amount', 'payment_method', 'status'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}