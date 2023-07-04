<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateBookingStatusByDetBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            $bookingDetails = BookingDetail::where('id_booking', $booking->id)->get();

            $allFinished = $bookingDetails->every(function ($detail) {
                return $detail->is_finish == 1;
            });
    
            if ($allFinished) {
                $booking->status = 1;
                $booking->save();
            }
        }
    }
}
