<?php

namespace App\Models\Examination;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id', 'diagnosis', 'treatment', 'notes', 'doctor_id'
    ];

    public function registration()
    {
        return $this->belongsTo(\App\Models\Registration::class);
    }

    public function doctor()
    {
        return $this->belongsTo(\App\Models\User::class, 'doctor_id');
    }
}