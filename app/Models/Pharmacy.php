<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id', 'medicine_name', 'quantity', 'instructions'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}