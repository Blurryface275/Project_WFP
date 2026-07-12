<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'doctor_id',
        'transaction_type',
        'payment_method',
        'status',
        'total_price',
        'notes',
        'date',
        'schedule_date',
        'schedule_time',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
