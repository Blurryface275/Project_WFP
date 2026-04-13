<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'user_id',
        'specialization',
        'experience_years',
        'phone_number',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}