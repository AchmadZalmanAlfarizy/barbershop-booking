<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name', 'phone', 'service_id', 'booking_date',
        'booking_time', 'queue_number', 'status', 'sale_amount',
    ];

    protected $casts = [
        'booking_date'  => 'date',
        'sale_amount'   => 'decimal:2',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'waiting'     => 'Menunggu',
            'in_progress' => 'Sedang Dilayani',
            'done'        => 'Selesai',
            'cancelled'   => 'Dibatalkan',
            default       => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'waiting'     => 'yellow',
            'in_progress' => 'blue',
            'done'        => 'green',
            'cancelled'   => 'red',
            default       => 'gray',
        };
    }
}
