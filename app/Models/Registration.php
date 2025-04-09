<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'registration_date', 'status', 
        'complaint', 'service_type'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}