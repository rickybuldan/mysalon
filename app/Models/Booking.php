<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'booking_date',
        'no_booking',
        'id_customer',
        'id_service_category',
        'status',
        'discount',
        'total_price',
    ];
    public static function generateNoBooking($paramDate)
    {
        $prefix = 'BR';
        $paramx=Carbon::createFromFormat('Y-m-d H:i:s', $paramDate)->format('dmY');
        $date=$paramx;
        $lastBooking = Booking::latest()->first();
    
        if ($lastBooking) {
         
            $lastDate = Carbon::createFromFormat('dmY', substr($lastBooking->no_booking, 3, 8));
            if ($lastDate->format('dmY') == $paramx) {
                $lastNumber = explode('/', $lastBooking->no_booking);
                $lastSerial = (int)end($lastNumber);
                $newSerial = $lastSerial + 1;
            } else {
                $newSerial = 1;
            }
        } else {
            $newSerial = 1;
        }
    
        $bookingNumber = $prefix . '/' . $date . '/' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);
    
        return $bookingNumber;
    }
    
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class, 'id_booking');
    }
    public function bookingProducts()
    {
        return $this->hasMany(BookingProduct::class, 'id_booking');
    }
    
}
