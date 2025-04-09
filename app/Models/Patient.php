<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'name', 'birth_date', 'gender', 
        'address', 'phone', 'bpjs_number'
    ];

    protected $dates = ['birth_date']; // Tambahkan ini
    // atau untuk Laravel versi terbaru:
    protected $casts = [
        'birth_date' => 'date'
    ];
}