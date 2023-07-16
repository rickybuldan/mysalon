<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\JsonDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Rute untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Rute untuk melakukan proses login
Route::post('/login', [LoginController::class, 'login']);
Route::get('/sign-up', [LoginController::class, 'signup'])->name('sign-up');
// Rute untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [IndexController::class, 'index'])->name('home');


//create customer 
Route::post('/ajax-createcustomer', [JsonDataController::class, 'createcustomer'])->name('createcustomer');
//invoice
Route::get('/invoice', [AdminController::class, 'invoice'])->name('invoice');


Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:Superadmin,Karyawan,Kasir,Recepsionist,Pemilik'])->group(function () {
        //VIEW
        Route::get('/tracking', [AdminController::class, 'tracking'])->name('tracking');
        Route::get('/listbooking', [AdminController::class, 'listbooking'])->name('listbooking');
        Route::get('/bookingsreport', [AdminController::class, 'bookingsreport'])->name('bookingsreport');
        Route::get('/bookingbysearch', [AdminController::class, 'bookingbysearch'])->name('bookingbysearch');
        Route::get('/services', [AdminController::class, 'services'])->name('services');
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/employees', [AdminController::class, 'employees'])->name('employees');
        Route::get('/employeeservices', [AdminController::class, 'employeeservices'])->name('employeeservices');
        Route::get('/booking', [AdminController::class, 'booking'])->name('booking');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        

        //dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/ajax-gettopservice', [JsonDataController::class, 'gettopservice'])->name('gettopservice');
        Route::get('/ajax-gettotaltable', [JsonDataController::class, 'gettotaltable'])->name('gettotaltable');
        Route::get('/ajax-getrecentbookings', [JsonDataController::class, 'getrecentbookings'])->name('getrecentbookings');

     

        // List Booking
        Route::get('/ajax-listbookings', [JsonDataController::class, 'getlistbookings'])->name('getlistbookings');
        Route::get('/ajax-getbookingtracking', [JsonDataController::class, 'getbookingtracking'])->name('getbookingtracking');
        Route::get('/ajax-detbooking', [JsonDataController::class, 'getdetbooking'])->name('getdetbooking');
        Route::get('/ajax-getdetbookingproduct', [JsonDataController::class, 'getdetbookingproduct'])->name('getdetbookingproduct');
        Route::post('/ajax-updatepaidbooking', [JsonDataController::class, 'updatepaidbooking'])->name('updatepaidbooking');
        Route::post('/ajax-updatebookingproductservice', [JsonDataController::class, 'updatebookingproductservice'])->name('updatebookingproductservice');

         // Employees
        Route::get('/ajax-listemployees', [JsonDataController::class, 'getlistemployees'])->name('getlistemployees');
        Route::post('/ajax-createemployee', [JsonDataController::class, 'createemployee'])->name('createemployee');
        Route::post('/ajax-updateemployee', [JsonDataController::class, 'updateemployee'])->name('updateemployee');
        Route::delete('/ajax-deleteemployee', [JsonDataController::class, 'deleteemployee'])->name('deleteemployee');
        
         // Employees Services
        Route::get('/ajax-listemployeeservices', [JsonDataController::class, 'getlistemployeeservices'])->name('getlistemployeeservices');
        Route::post('/ajax-createemployeeservice', [JsonDataController::class, 'createemployeeservice'])->name('createemployeeservice');
        Route::post('/ajax-updateemployeeservice', [JsonDataController::class, 'updateemployeeservice'])->name('updateemployeeservice');
        Route::delete('/ajax-deleteemployeeservice', [JsonDataController::class, 'deleteemployeeservice'])->name('deleteemployeeservice');

        // Services
        // Route::get('/ajax-listservices', [JsonDataController::class, 'getlistservices'])->name('getlistservices');
        Route::get('/ajax-listservicecategories', [JsonDataController::class, 'getlistservicecategories'])->name('getlistservicecategories');
        Route::post('/ajax-createservice', [JsonDataController::class, 'createservice'])->name('createservice');
        Route::post('/ajax-updateservice', [JsonDataController::class, 'updateservice'])->name('updateservice');
        Route::delete('/ajax-deleteservice', [JsonDataController::class, 'deleteservice'])->name('deleteservice');

        // booking product
        Route::post('/ajax-updatebookingproduct', [JsonDataController::class, 'updatebookingproduct'])->name('updatebookingproduct');

        // Products
        Route::get('/ajax-getlistproducts', [JsonDataController::class, 'getlistproducts'])->name('getlistproducts');
        
        //tracking
        Route::post('/ajax-updatestatusdetbooking', [JsonDataController::class, 'updatestatusdetbooking'])->name('updatestatusdetbooking');

        // Customers
        Route::get('/ajax-listcustomers', [JsonDataController::class, 'getlistcustomers'])->name('getlistcustomers');
    });


    
    Route::get('/ajax-listservices', [JsonDataController::class, 'getlistservices'])->name('getlistservices');
    
    // landing page
    Route::get('/ajax-listservices', [JsonDataController::class, 'getlistservices'])->name('getlistservices');
    // Employees
    Route::get('/ajax-listemployees', [JsonDataController::class, 'getlistemployees'])->name('getlistemployees');

    //Employee Services
    Route::get('/ajax-getemployeebyservice', [JsonDataController::class, 'getemployeebyservice'])->name('getemployeebyservice');

    //Booking
    Route::post('/ajax-createbookingonline', [JsonDataController::class, 'createbookingonline'])->name('createbookingonline');
    Route::post('/ajax-createbookingoffline', [JsonDataController::class, 'createbookingoffline'])->name('createbookingoffline');


    
    Route::middleware(['role:Superadmin'])->group(function () {
    
        // VIEW 
        Route::get('/users-manager', [AdminController::class, 'usersmanager'])->name('users-manager');


        
        // JSON DATA

        // Users
        Route::get('/ajax-listusers', [JsonDataController::class, 'getlistusers'])->name('getlistusers');
        Route::get('/ajax-listroles', [JsonDataController::class, 'getlistroles'])->name('getlistroles');
        Route::post('/ajax-createuser', [JsonDataController::class, 'createuser'])->name('createuser');
        Route::post('/ajax-updateuser', [JsonDataController::class, 'updateuser'])->name('updateuser');
        Route::delete('/ajax-deleteuser', [JsonDataController::class, 'deleteuser'])->name('deleteuser');

        // Products
        Route::get('/ajax-listproducts', [JsonDataController::class, 'getlistproducts'])->name('getlistproducts');
        Route::post('/ajax-createproduct', [JsonDataController::class, 'createproduct'])->name('createproduct');
        Route::post('/ajax-updateproduct', [JsonDataController::class, 'updateproduct'])->name('updateproduct');
        Route::delete('/ajax-deleteproduct', [JsonDataController::class, 'deleteproduct'])->name('deleteproduct');
  

         // Customers
        // Route::get('/ajax-listcustomers', [JsonDataController::class, 'getlistcustomers'])->name('getlistcustomers');
        Route::post('/ajax-updatecustomer', [JsonDataController::class, 'updatecustomer'])->name('updatecustomer');
        Route::delete('/ajax-deletecustomer', [JsonDataController::class, 'deletecustomer'])->name('deletecustomer');

    });

});