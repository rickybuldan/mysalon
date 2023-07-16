<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   
 
    public function dashboard(Request $request){
        $javascriptFile = asset('action-js/dashboard/dashboard-action.js');
        return view('pages.admin.dashboard')->with('javascriptFile', $javascriptFile);
    }
    public function usersmanager(Request $request){

        $javascriptFile = asset('action-js/users/users-action.js');
        return view('pages.admin.users.usersmanager')->with('javascriptFile', $javascriptFile);

    }
    public function services(Request $request){

        $javascriptFile = asset('action-js/services/services-action.js');
        return view('pages.admin.services.services')->with('javascriptFile', $javascriptFile);

    }
    public function customers(Request $request){

        $javascriptFile = asset('action-js/customers/customers-action.js');
        return view('pages.admin.customers.customers')->with('javascriptFile', $javascriptFile);

    }

    public function products(Request $request){

        $javascriptFile = asset('action-js/products/products-action.js');
        return view('pages.admin.products.products')->with('javascriptFile', $javascriptFile);

    }

    public function booking(Request $request){

        $javascriptFile = asset('action-js/bookings/booking-action.js');
        return view('pages.admin.booking.booking')->with('javascriptFile', $javascriptFile);

    }
    public function employees(Request $request){

        $javascriptFile = asset('action-js/employees/employees-action.js');
        return view('pages.admin.employees.employees')->with('javascriptFile', $javascriptFile);

    }
    public function employeeservices(Request $request){

        $javascriptFile = asset('action-js/employees/employeeservices-action.js');
        return view('pages.admin.employees.employeeservices')->with('javascriptFile', $javascriptFile);

    }

    public function listbooking(Request $request){

        $javascriptFile = asset('action-js/bookings/listbookings-action.js');
        return view('pages.admin.booking.listbooking')->with('javascriptFile', $javascriptFile);

    }

    public function tracking(Request $request){

        $javascriptFile = asset('action-js/trackings/tracking-action.js');
        return view('pages.admin.tracking.tracking')->with('javascriptFile', $javascriptFile);

    }
  
    public function  bookingsreport(Request $request){

        $javascriptFile = asset('action-js/bookings/bookingsreport-action.js');
        return view('pages.admin.booking.bookingsreport')->with('javascriptFile', $javascriptFile);

    }
    public function  invoice(Request $request){
        $param1 = $request->query('no-booking');
        // BR/06072023/00001
        $query = "
        SELECT
            bk.*,
            sc.service_name,
            sc.price,
            bk.discount,
            cs.`name` AS name_customer,
            TIMESTAMPDIFF(MINUTE, bk.booking_date, bk.estimate_end) AS total_duration,
            CASE		
                WHEN bk.STATUS = 1 THEN
                'already done' 
                WHEN bk.STATUS = 0 THEN
                'idle' 
                WHEN bk.STATUS = 3 THEN
                'expired/canceled' ELSE 'unknown' 
            END AS status_text 
        FROM
            bookings bk
            LEFT JOIN booking_details bd ON bd.id_booking=bk.id 
            LEFT JOIN users us ON us.id = bk.id_customer
            LEFT JOIN customers cs ON cs.email = us.email
            LEFT JOIN services sc ON sc.id = bd.id_service
        WHERE no_booking='".$param1."'"
        ;

        $query2 = "
        SELECT
            bd.*,
            p.name AS name_product,
            p.price,
            bk.discount,
            (bd.quantity * p.price) AS total_price
        FROM
            bookings bk
            LEFT JOIN booking_products bd ON bd.id_booking=bk.id 
            LEFT JOIN products p ON p.id = bd.id_product
        WHERE no_booking='".$param1."'"
        ;
        // dd($query2);
        $data = DB::select($query); 
        $data2 = DB::select($query2);
        // dd($data);
        $javascriptFile = asset('action-js/bookings/bookingsreport-action.js');
        return view('pages.admin.booking.invoice')->with([  'javascriptFile' => $javascriptFile, 'param1' => $param1, 'data' => $data, 'data2' => $data2]);

    }
    public function  bookingbysearch(Request $request){
        $id = $request->query('id');
 
        $javascriptFile = asset('action-js/bookings/bookingbysearch-action.js');
        return view('pages.admin.booking.bookingbysearch')->with([  'javascriptFile' => $javascriptFile, 'id' => $id]);
    }


}
