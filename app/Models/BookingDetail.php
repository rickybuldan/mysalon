<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table = 'booking_details';
    protected $fillable = [
        'id_booking',
        'id_service',
        'id_employee',
        'is_finish',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id');
    }
}
