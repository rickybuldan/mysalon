<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingProduct extends Model
{
    use HasFactory;
    protected $table = 'booking_products';
    protected $fillable = [
        'id_product',
        'id_booking',
        'quantity',
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id');
    }
}
