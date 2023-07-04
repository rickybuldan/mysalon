<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\BookingDetail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateBookingStatus implements ShouldQueue
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
        $currentTime = Carbon::now();
        $newTime = $currentTime->addMinutes(30);
        $bookings = Booking::where('booking_date', '<=', $newTime)->where('status', 0)->get();
        // $newTime = $currentTime;
        // $bookings = Booking::where('booking_date', '<=', $newTime)
        // ->where('status', 0)
        // ->where('estimate_end', '<=', $newTime)
        // ->get();

   
        // foreach ($bookings as $booking) {
        //     $booking->status = 2;
        //     $booking->save();
        //     $bookingDetails = BookingDetail::where('id_booking', $booking->id)->get();

        //     foreach ($bookingDetails as $bookingDetail) {
        //         $bookingDetail->is_finish = 2;
        //         $bookingDetail->save();
        //     }
        // }
        foreach ($bookings as $booking) {
            $bookingDetails = BookingDetail::where('id_booking', $booking->id)->get();
            $isFinish = $bookingDetails->contains(function ($bookingDetail) {
                return $bookingDetail->is_finish == 1;
            });
    
            if (!$isFinish) {
                $booking->status = 2;
                $booking->save();
            }
    
            // foreach ($bookingDetails as $bookingDetail) {
            //     $bookingDetail->is_finish = 2;
            //     $bookingDetail->save();
            // }
        }
        // dd(Carbon::now());
    }
}
