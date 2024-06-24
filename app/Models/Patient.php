<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'address',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
}
