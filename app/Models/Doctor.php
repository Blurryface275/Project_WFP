<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'specialization',
        'experience_years',
        'phone_number',
        'email',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
