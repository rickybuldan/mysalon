<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
