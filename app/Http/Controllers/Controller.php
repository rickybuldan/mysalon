<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Jobs\UpdateBookingStatus;
use App\Jobs\UpdateBookingStatusByDetBooking;
use App\Models\BookingDetail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $bookingDetail;
    public function __construct(BookingDetail $bookingDetail)
    {
        $this->bookingDetail = $bookingDetail;
        UpdateBookingStatus::dispatch()->delay(now()->addSeconds(10));
        UpdateBookingStatusByDetBooking::dispatch()->delay(now()->addSeconds(10));
        
    }
}
