<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingProduct;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class JsonDataController extends Controller
{
    // protected $bookingDetail;
    // // public function __construct(BookingDetail $bookingDetail)
    // // {
    // //     $this->bookingDetail = $bookingDetail;
    // //     UpdateBookingStatus::dispatch()->delay(now()->addSeconds(10));
        
    // // }
    
    //
    public function getlistusers(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    us.id,
                    us.name,
                    us.email,
                    us.is_active,
                    us.id_role,
                    ur.role_name 
                FROM
                    users us
                    LEFT JOIN user_roles ur ON us.id_role = ur.role_code
                WHERE us.is_deleted = 0
            ";

            $users = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $users,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }
    public function getlistroles(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    *
                FROM
                    user_roles
            ";
            $search = $request->get('q');

            if ($search) {
                $query .= " WHERE role_name LIKE ?";
                $data = DB::select($query, ["%$search%"]);
            } else {
                $data = DB::select($query);
            }


            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }
    public function createuser(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'id_role' =>   'required|exists:user_roles,role_code',
                'is_active' => 'required',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $user = new User;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->password);
            $user->id_role = $data->id_role;
            $user->is_active = $data->is_active;
            $user->is_deleted = 0;
            $user->save();

            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'User created successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function updateuser(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $data->id,
                'password' => 'required|min:6',
                'id_role' => 'required',
                'is_active' => 'required',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $user = User::find($data->id);

            if (!$user) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'User not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }

            // Update data user
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->password);
            $user->id_role = $data->id_role;
            $user->is_active = $data->is_active;
            $user->is_deleted = 0;
            $user->save();

            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'User updated successfully.',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function deleteuser(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
    
            // Cari pengguna berdasarkan ID
            $user = User::find($data->id);
    
            if (!$user) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'User not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }
    
            // Hapus pengguna
            $user->delete();
    
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'User deleted successfully.',
                'data' => $data,
            ];
    
            // Kembalikan data dalam format JSON
            return response()->json($responseData);
    
        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
    
            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getlistservices(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    sr.*,
                    sc.category_name
                FROM
                    services sr
                LEFT JOIN servicecategories sc ON sr.id_category =sc.id
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getlistservicecategories(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    *
                FROM
                    servicecategories
            ";
            $search = $request->get('q');

            if ($search) {
                $query .= " WHERE category_name LIKE ?";
                $data = DB::select($query, ["%$search%"]);
            } else {
                $data = DB::select($query);
            }

            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }
    
    public function createservice(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'service_name' => 'required',
                'price' => 'required',
                'id_category' => 'required',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $service = new Service;
            $service->service_name = $data->service_name;
            $service->price = $data->price;
            $service->id_category = $data->id_category;
            $service->desc = $data->desc;
            $service->picture = "";
            $service->save();

            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Service created successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function updateservice(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'service_name' => 'required',
                'price' => 'required',
                'id_category' => 'required',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $service = Service::find($data->id);

            if (!$service) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Service not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }

            // Update data user
            // $service = new Service;
            $service->service_name = $data->service_name;
            $service->price = $data->price;
            $service->id_category = $data->id_category;
            $service->duration = $data->duration;
            $service->desc = $data->desc;
            $service->picture = $data->picture;
            $service->save();

            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Service updated successfully.',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }
    
    public function deleteservice(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
    
            // Cari pengguna berdasarkan ID
            $Service = Service::find($data->id);
    
            if (!$Service) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Service not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }
    
            // Hapus pengguna
            $Service->delete();
    
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Service deleted successfully.',
                'data' => $data,
            ];
    
            // Kembalikan data dalam format JSON
            return response()->json($responseData);
    
        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
    
            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    
    public function getlistcustomers(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    sr.*
                FROM
                    customers sr
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    
    public function createcustomer(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:customers',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            DB::beginTransaction();
            if(isset($data->password)){
                $password= Hash::make($data->password);
            }else{
                $password=Hash::make('admin123');
            }
            // Simpan data pelanggan (customer)
            $customer = new Customer;
            $customer->name = $data->name;
            $customer->phone = $data->phone;
            $customer->email = $data->email;
            $customer->save();
    
            // Buat pengguna (user) baru
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => $password,
                'id_role' => 50,
                'is_active' =>1,
                'is_deleted' =>0,
            ]);
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Customer with user login created successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function updatecustomer(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                // 'phone' => 'required|unique:customers',
                // 'email' => 'required|unique:users',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $Customer = Customer::find($data->id);

            if (!$Customer) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Customer not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }
            
            DB::beginTransaction();

            // Cari data pelanggan (customer) berdasarkan ID
            $customer = Customer::findOrFail($data->id);
            $customer->name = $data->name;
            $customer->phone = $data->phone;
            $customer->email = $data->email;
            $customer->save();
    
            // Cari data pengguna (user) berdasarkan email
            $user = User::where('email', $customer->email)->first();
            if ($user) {
                $user->name = $data->name;
                $user->email = $data->email;
                $user->save();
            }
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Customer with user login updated successfully.',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }
    
    public function deletecustomer(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
    
            // Cari pengguna berdasarkan ID
            $customer = Customer::findOrFail($data->id);

            // Hapus data pengguna (user) berdasarkan email
            $user = User::where('email', $customer->email)->first();
            if ($user) {
                $user->delete();
            }
    
            // Hapus data pelanggan (customer)
            $customer->delete();

            DB::commit();
    
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Customer and user login deleted successfully.',
                'data' => $data,
            ];
    
            // Kembalikan data dalam format JSON
            return response()->json($responseData);
    
        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
    
            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }


    public function getlistemployees(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    sr.*,
                    ur.role_name,
                    us.id_role
                FROM
                    employees sr
                LEFT JOIN users us ON us.email = sr.email
                LEFT JOIN user_roles ur ON us.id_role= ur.role_code
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    
    public function createemployee(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:employees',
                'role_code'=>'required|exists:user_roles,role_code',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
                'image' => 'string|image64:jpeg,png,jpg', // Validasi gambar Base64
            ]);
            // dd($data);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }


            DB::beginTransaction();
            $imagePath = null;
            $filename=null;
            $imageData = $request->input('image');
            if($imageData){
                $image = Image::make($imageData);

                // Nama file baru untuk gambar
                $filename = Str::random(40) . '.jpg';

                // Simpan gambar di folder 'public/images'
                $imagePath = public_path('images/') . $filename;
                $image->save($imagePath);
            }

                

            // Simpan data pelanggan (employee)
            $employee = new Employee;
            $employee->name = $data->name;
            $employee->phone = $data->phone;
            $employee->email = $data->email;
            $employee->path = $filename; 
            $employee->save();
    
 
            // Buat pengguna (user) baru
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make('admin123'),
                'id_role' => $data->role_code,
                'is_active' =>1,
                'is_deleted' =>0,
            ]);
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Employee with user login created successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    
    public function updateemployee(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                // 'name' => 'required',
                // 'phone' => 'required|unique:employees',
                // 'email' => 'required|unique:users',
                // 'image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $Employee = Employee::find($data->id);

            if (!$Employee) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Employee not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }
            
            DB::beginTransaction();
    
            // Delete the existing image if it exists
            if ($Employee && $Employee->path) {
                $existingImagePath = public_path('images/') . $Employee->path;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }
            
            $filename=null;
            $imageData = $request->input('image');
            if($imageData){
                $image = Image::make($imageData);

                // Nama file baru untuk gambar
                $filename = Str::random(40) . '.jpg';

                // Simpan gambar di folder 'public/images'
                $imagePath = public_path('images/') . $filename;
                $image->save($imagePath);
            }
            // Cari data pelanggan (customer) berdasarkan ID
            $Employee = Employee::findOrFail($data->id);
            $Employee->name = $data->name;
            $Employee->phone = $data->phone;
            $Employee->email = $data->email;
            $Employee->path = $filename;
            $Employee->save();
    
            // Cari data pengguna (user) berdasarkan email
            $user = User::where('email', $Employee->email)->first();
            if ($user) {
                $user->name = $data->name;
                $user->email = $data->email;
                $user->save();
            }
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Employee with user login updated successfully.',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }
    
    public function deleteemployee(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
    
            // Cari pengguna berdasarkan ID
            $Employee = Employee::findOrFail($data->id);
    
            // Delete the existing image if it exists
            if ($Employee && $Employee->path) {
                $existingImagePath = public_path('images/') . $Employee->path;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }
            $Employee->delete();

            // Hapus data pengguna (user) berdasarkan email
            $user = User::where('email', $Employee->email)->first();
            if ($user) {
                $user->delete();
            }
    
            // Hapus data pelanggan (Employee)
        

            DB::commit();
    
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Employee and user login deleted successfully.',
                'data' => $data,
            ];
    
            // Kembalikan data dalam format JSON
            return response()->json($responseData);
    
        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
    
            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getlistemployeeservices(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    sr.*,
                    em.`name` AS employee_name,
                    sv.service_name
                FROM
                    employee_services sr
                    LEFT JOIN employees em ON sr.id_employee = em.id
                    LEFT JOIN services sv ON sv.id = sr.id_service
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function createemployeeservice(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent(),true);
          
         
            $validator = Validator::make($data, [
                'id_employee' => 'required|exists:employees,id',
                'id_service' => 'required|exists:services,id',
            ]);      

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }
            
            $employee = Employee::findOrFail($data['id_employee']);
            $existingServices = $employee->services()->pluck('id')->toArray();

            if (in_array($data['id_service'], $existingServices)) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Service is already assigned to the employee.',
                ];
                return response()->json($errorResponse, 422);
            }
            
            DB::beginTransaction();

       
            $employee->services()->attach($data['id_service']);
           
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Service assigned to the employee successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function updateemployeeservice(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent(),true);
          
         
            $validator = Validator::make($data, [
                'id_employee' => 'required|exists:employees,id',
                'id_service' => 'required|exists:services,id',
            ]);      

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $employee = Employee::findOrFail($data['id_employee']);
            $existingServices = $employee->services()->pluck('id')->toArray();
    
            if (in_array($data['id_service'], $existingServices)) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Service is already assigned to the employee.',
                ];
                return response()->json($errorResponse, 422);
            }
    
            DB::beginTransaction();
    
            // Menghapus layanan yang ada sebelumnya
            $employee->services()->detach();
    
            // Menambahkan layanan baru
            $employee->services()->attach($data['id_service']);
    
           
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Service assigned to the employee successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function getemployeebyservice(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');
            $data = $request->query('id_service');
            $date = $request->query('date');
         

            $query = "
            SELECT
                es.*,
                ep.name,
                ep.path,
                CASE WHEN bd.id_employee IS NOT NULL THEN 'Booked' ELSE 'Idle' END AS status_booked
            
            FROM
                employee_services es
                LEFT JOIN employees ep ON ep.id = es.id_employee
                LEFT JOIN (
                    SELECT DISTINCT bd.id_employee, bk.id
                    FROM booking_details bd
                    INNER JOIN bookings bk ON bk.id = bd.id_booking AND bk.booking_date = '".$date."'
                    WHERE bd.is_finish = 0 AND bk.status = 0
                ) bd ON bd.id_employee = es.id_employee
            WHERE
                es.id_service = ".$data;
        

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getlistbookings(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    bk.*,
                    sc.category_name,
                    cs.`name` AS name_customer,
                    TIMESTAMPDIFF(MINUTE, bk.booking_date, bk.estimate_end) AS total_duration
                FROM
                    bookings bk
                    LEFT JOIN users us ON us.id = bk.id_customer
                    LEFT JOIN customers cs ON cs.email = us.email
                    LEFT JOIN servicecategories sc ON sc.id = bk.id_service_category
                ORDER BY bk.created_at DESC
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getdetbooking(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');
            $data = $request->query('id');
            $query = "
                SELECT
                    bk.booking_date,
                    bk.no_booking,
                    bk.discount,
                    bk.total_price,
                    bd.*,
                    sv.service_name,
                    em.`name` AS employee_name,
                    sc.category_name,
                    cs.`name` AS name_customer,
                    cs.phone,
                    cs.email,
                    cs.id AS id_customer
                FROM
                    bookings bk
                    LEFT JOIN users us ON us.id = bk.id_customer
                    LEFT JOIN customers cs ON cs.email = us.email
                    LEFT JOIN servicecategories sc ON sc.id = bk.id_service_category
                    LEFT JOIN booking_details bd ON bd.id_booking = bk.id
                    LEFT JOIN services sv ON sv.id = bd.id_service
                    LEFT JOIN employees em ON em.id = bd.id_employee
                WHERE bk.id=
            ".$data;

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function updatestatusdetbooking(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());
            $userId = Auth::id();

            $validator = Validator::make((array) $data, [
                'id'=>'required|exists:booking_details,id'
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }
            DB::beginTransaction();
            $Employee = Employee::findOrFail($data->id_employee);
            $Employee->get();
    
            // Cari data pengguna (user) berdasarkan email
            $user = User::where('email', $Employee->email)->first();
            // if($user->id!=$userId){
            //     $errorResponse = [
            //         'status' => 'error',
            //         'message' => "Unauthorized, only"." ".$user->name." "."to do! " ,
            //     ];
            //     return response()->json($errorResponse, 402); // Kode status 422 untuk validasi gagal
            // }
            // Simpan data pelanggan (employee)
            $BookingDetail = BookingDetail::findOrFail($data->id);
            $BookingDetail->is_finish = 1;
            $BookingDetail->save();
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Status updated successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function updatepaidbooking(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());
            $userId = Auth::id();

            $validator = Validator::make((array) $data, [
                'id'=>'required|exists:bookings,id'
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }
            DB::beginTransaction();

    
            // Batasi dengan Role
            $user = User::where('id', $userId)->first();
            if($user->id_role!=40){
                $errorResponse = [
                    'status' => 'error',
                    'message' => "Unauthorized, only"." role Kasir "."can do! " ,
                ];
                return response()->json($errorResponse, 402); // Kode status 422 untuk validasi gagal
            }

            $Booking = Booking::findOrFail($data->id);
            $Booking->is_paid = 1;
            $Booking->save();
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Status updated successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    // DASHBOARD
    public function gettopservice(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT s.service_name, COUNT(*) AS total_bookings
                FROM booking_details bd
                    LEFT JOIN services s ON s.id = bd.id_service
                GROUP BY s.service_name
                ORDER BY total_bookings DESC LIMIT 3;
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }
    public function gettotaltable(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    'users' AS table_name,
                    (SELECT COUNT(*) FROM users) AS total_records
                UNION ALL
                SELECT
                    'bookings' AS table_name,
                    (SELECT COUNT(*) FROM bookings) AS total_records
                UNION ALL
                SELECT
                    'employees' AS table_name,
                    (SELECT COUNT(*) FROM employees) AS total_records
                UNION ALL
                SELECT 
                        'revenue' AS table_name,
                    (SELECT SUM(total_price)FROM bookings  WHERE is_paid=1) AS total_records
        
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getrecentbookings(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    bk.*,
                    sc.category_name,
                    cs.`name`AS name_customer
                FROM
                    bookings bk
                    LEFT JOIN users us ON us.id = bk.id_customer
                    LEFT JOIN customers cs ON cs.email = us.email
                    LEFT JOIN servicecategories sc ON sc.id = bk.id_service_category
                ORDER BY bk.created_at DESC LIMIT 3
            ";

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }
    public function getbookingtracking(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $now = Carbon::now()->format('Y-m-d H:i:s');

            $query = "
                SELECT
                    bk.*,
                    sc.category_name,
                    cs.`name` AS name_customer,
                    TIMESTAMPDIFF(MINUTE, bk.booking_date, bk.estimate_end) AS total_duration
                FROM
                    bookings bk
                    LEFT JOIN users us ON us.id = bk.id_customer
                    LEFT JOIN customers cs ON cs.email = us.email
                    LEFT JOIN servicecategories sc ON sc.id = bk.id_service_category
                WHERE
                    bk.booking_date >= '$now' AND bk.status = 0
                ORDER BY ABS(TIMESTAMPDIFF(SECOND, '$now', bk.booking_date))
            ";
            
            

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function getdetbookingproduct(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');
            $data = $request->query('id');
            $query = "
            SELECT
                bd.*,
                p.name AS name_product,
                bd.quantity,
                (bd.quantity * p.price) AS total_price
            FROM
                bookings bk
                LEFT JOIN booking_products bd ON bd.id_booking=bk.id 
                LEFT JOIN products p ON p.id = bd.id_product
            WHERE bk.id='".$data."'";
           
            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            if($data[0]->id==""){
                $data="";
            }
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function updatebookingproductservice(Request $request)
    {
        try {
            // Validasi input
            $user = Auth::user();
            $userId = Auth::id();
            $data = json_decode($request->getContent() , true);
            // dd($data);
           
            $validator = Validator::make((array) $data, [
                'booking_date' => 'required',
                
                // 'id_customer' => 'exists:customers,id',
                'booking_details' => 'required|array',
                'booking_details.*.id_service' => 'required|exists:services,id',
                'booking_details.*.id_employee' => [
                    'required',
                    'exists:employees,id',
                    function ($attribute, $value, $fail) use ($data) {
                        // Lakukan pemeriksaan khusus di sini
                        // Contoh: Jika nilai id_employee sama dengan "booked", maka validasi gagal
                        if ($value == "Booked") {
                            $fail('The selected employee is already booked.');
                        }
                    }
                ],
                'booking_products.*.id_product' => 'exists:products,id',
                'booking_products.*.qty' => [
                    'integer',
                    'gt:0',
                    function ($attribute, $value, $fail) use ($data) {
                        $productId = $data['booking_products'][$attribute]['id_product'];
                        $product = Product::find($productId);
                        if ($product && $product->stock - $value < 0) {
                            $fail('The product stock is insufficient.');
                        }
                    }
                ],
            ],);
              

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }
            
            DB::beginTransaction();

            $bookingProducts = $data['booking_products'];
            $bookingDetails = $data['booking_details'];
            $totalPricex = 0;
            $totalPricey = 0;

            foreach ($bookingProducts as $bookingProduct) {
                $idProduct = $bookingProduct['id_product'];
                $quantity = $bookingProduct['qty'];
                $price = DB::table('products')
                ->where('id', $idProduct)
                ->value('price');
    
                $totalPricex += $price * $quantity;
                BookingProduct::updateOrCreate(
                    ['id_booking' => $data['id_booking'], 'id_product' => $idProduct],
                    ['quantity' => $quantity]
                );
            }

            foreach ($bookingDetails as $bookingDetail) {
                $idservice = $bookingDetail['id_service'];
                $id_employee = $bookingDetail['id_employee'];
                $price = DB::table('services')
                ->where('id', $idservice)
                ->value('price');
                $totalPricey += $price * $quantity;
                BookingDetail::updateOrCreate(
                    ['id_booking' => $data['id_booking'], 'id_service' => $idservice],
                    ['id_employee' => $id_employee, 'is_finish' => 0]
                );
            }
            
            $idServices = Arr::pluck($data['booking_details'], 'id_service');
            
            $totalDuration = DB::table('services')
            ->whereIn('id', $idServices)
            ->sum('duration');
            
            $totalHourDuration=($totalDuration/60);

            $EstimateDuration = Carbon::createFromFormat('Y-m-d H:i:s', $data['booking_date'])
            ->addHours($totalHourDuration)
            ->format('Y-m-d H:i:s');

            
            $Booking = Booking::findOrFail($data['id_booking']);
            // hitung product
            $Booking->estimate_end = $EstimateDuration;
            $Booking->total_price = $totalPricex + $totalPricey;
            $Booking->save();
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Booking created successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function createbookingonline(Request $request)
    {
        try {
            // Validasi input
            $user = Auth::user();
            $userId = Auth::id();
            $data = json_decode($request->getContent() , true);
            // dd($data);
            $user = User::findOrFail($userId);
            
            // Cari data pengguna (user) berdasarkan email
            $type=1;
            $customer = Customer::where('email', $user->email)->first();
            if ($customer) {
                $data ['customer_name']=$customer->name;
                $data ['customer_phone']=$customer->phone;
                $data ['customer_email']=$customer->email;
                $type=2;
            }
           
            $validator = Validator::make((array) $data, [
                'booking_date' => 'required',
               
                // 'id_customer' => 'required|exists:customers,id',
                'booking_details' => 'required|array',
                'booking_details.*.id_service' => 'required|exists:services,id',
                'booking_details.*.id_employee' => [
                    'required',
                    'exists:employees,id',
                    function ($attribute, $value, $fail) use ($data) {
                        // Lakukan pemeriksaan khusus di sini
                        // Contoh: Jika nilai id_employee sama dengan "booked", maka validasi gagal
                        if ($value == "Booked") {
                            $fail('The selected employee is already booked.');
                        }
                    }
                ],
                'booking_products.*.id_product' => 'exists:products,id',
                // 'booking_products.*.qty' => '',
                'customer_name' => 'required',
                // 'customer_email' => 'email|unique:users,email',
                // 'customer_phone' => 'required|unique:customers,phone',
            ],);
              

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }
          
            
            DB::beginTransaction(); 
            $customer = Customer::updateOrCreate(
                ['email' => $data['customer_email']],
                [
                    'name' => $data['customer_name'],
                    'phone' => $data['customer_phone'],
                    'email' => $data['customer_email'],
                ]
            );

            $password = !empty($data['password']) ? Hash::make($data['password']) : Hash::make('admin123');
            
            if (!empty($data['customer_email'])) {
                $user = User::updateOrCreate(
                    ['email' => $data['customer_email']],
                    [
                        'name' => $data['customer_name'],
                        'password' => $password,
                        'id_role' => 50,
                        'is_active' => 1,
                        'is_deleted' => 0,
                    ]
                );
            
                $userId = $user->id;
            }
          
            
            
            $bookingDate = Carbon::createFromFormat('Y-m-d H:i:s', $data['booking_date'])->format('Y-m-d H:i:s');
            $bookingNumber = Booking::generateNoBooking($bookingDate);

            $Booking = new Booking;
            $Booking->booking_date = $bookingDate;
            $Booking->no_booking = $bookingNumber;
            $Booking->id_customer = $userId;
            $Booking->id_service_category = 8; //non paket
            $Booking->status = 0;
            $Booking->type = $type;
            $Booking->discount = 0;
          

            // hitung price service
            $idServices = Arr::pluck($data['booking_details'], 'id_service');
            $totalPrice = DB::table('services')
                ->whereIn('id', $idServices)
                ->sum('price');
            
            $totalDuration = DB::table('services')
            ->whereIn('id', $idServices)
            ->sum('duration');
            
            $totalHourDuration=($totalDuration/60);

            $EstimateDuration = Carbon::createFromFormat('Y-m-d H:i:s', $data['booking_date'])
            ->addHours($totalHourDuration)
            ->format('Y-m-d H:i:s');

            // hitung product
            // dd($data['booking_products']);
            $totalPricex = 0;
            if (!empty($data['booking_products'])) {
                foreach ($data['booking_products'] as $bookingProduct) {
                    $idProduct = $bookingProduct['id_product'];
                    $quantity = $bookingProduct['qty'];
            
                    $price = DB::table('products')
                        ->where('id', $idProduct)
                        ->value('price');
            
                    $totalPricex += $price * $quantity;
                }
            }
        
            
            $Booking->total_price = $totalPrice+$totalPricex;
            $Booking->estimate_end = $EstimateDuration;
            $Booking->save();


            $bookingDetails = [];
            foreach ($data['booking_details'] as $bookingDetail) {
                $bookingDetails[] = new BookingDetail([
                    'id_booking' => $Booking->id,
                    'id_service' => $bookingDetail['id_service'],
                    'id_employee' => $bookingDetail['id_employee'],
                    'is_finish' => 0,
                ]);
            }
            $Booking->bookingDetails()->saveMany($bookingDetails);

            if(!empty($data['booking_products'])){
                $bookingProducts = [];
                foreach ($data['booking_products'] as $bookingProduct) {
                    $bookingProducts[] = new BookingProduct([
                        'id_booking' => $Booking->id,
                        'id_product' => $bookingProduct['id_product'],
                        'quantity' => $bookingProduct['qty'],
                    ]);
                }
                $Booking->bookingProducts()->saveMany($bookingProducts );
            }
    
            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Booking created successfully.',
                'data' => $bookingNumber,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function createbookingoffline(Request $request)
    {
        try {
            // Validasi input
            $user = Auth::user();
            $userId = Auth::id();
            $data = json_decode($request->getContent() , true);
            // dd($data);
            // $user = User::findOrFail($userId);
            
            // Cari data pengguna (user) berdasarkan email
            if($data['type']==1){
                $data['id_customer']="";
                $validator = Validator::make((array) $data, [
                    'booking_date' => 'required',
                    
                    // 'id_customer' => 'exists:customers,id',
                    'booking_details' => 'required|array',
                    'booking_details.*.id_service' => 'required|exists:services,id',
                    'booking_details.*.id_employee' => [
                        'required',
                        'exists:employees,id',
                        function ($attribute, $value, $fail) use ($data) {
                            // Lakukan pemeriksaan khusus di sini
                            // Contoh: Jika nilai id_employee sama dengan "booked", maka validasi gagal
                            if ($value == "Booked") {
                                $fail('The selected employee is already booked.');
                            }
                        }
                    ],
                    'booking_products.*.id_product' => 'exists:products,id',
                    'booking_products.*.qty' => 'integer|gt:0',
                    'customer_name' => 'required',
                    'customer_email' => 'email|unique:users,email',
                    'customer_phone' => 'required|unique:customers,phone',
                ],);  

            }else{
                $data['customer_name']="";
                // $data['customer_email']="";
                $data['customer_phone']="";
                $validator = Validator::make((array) $data, [
                    'booking_date' => 'required',
                    
                    'id_customer' => 'required|exists:customers,id',
                    'booking_details' => 'required|array',
                    'booking_details.*.id_service' => 'required|exists:services,id',
                    'booking_details.*.id_employee' => [
                        'required',
                        'exists:employees,id',
                        function ($attribute, $value, $fail) use ($data) {
                            // Lakukan pemeriksaan khusus di sini
                            // Contoh: Jika nilai id_employee sama dengan "booked", maka validasi gagal
                            if ($value == "Booked") {
                                $fail('The selected employee is already booked.');
                            }
                        }
                    ],
                    'booking_products.*.id_product' => 'exists:products,id',
                    'booking_products.*.qty' => 'integer|gt:0',
                    // 'customer_name' => 'required',
                    // 'customer_email' => 'email|unique:users,email',
                    // 'customer_phone' => 'required|unique:customers,phone',
                ],);  
               
                $getuser = User::where('email', $data['customer_email'])->first();
                $userId = $getuser->id;
            }


            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }
          
            
            DB::beginTransaction(); 

           

            if (empty($data['id_customer'])) {
                $customer = Customer::create(
                    [
                        'name' => $data['customer_name'],
                        'phone' => $data['customer_phone'],
                        'email' =>  !empty($data['customer_email']) ? $data['customer_email'] : Str::random(10).'@example.com',
                        // 'email'=> !empty($data['customer_email']) ? $data['customer_email'] : ""
                    ]
                );
            }
           
            if (!empty($customer->email)) {
                $password = !empty($data['password']) ? Hash::make($data['password']) : Hash::make('admin123');
                $user = User::create(
                    [
                        'name' => $data['customer_name'],
                        'email'=> $customer->email,
                        'password' => $password,
                        'id_role' => 50,
                        'is_active' => 1,
                        'is_deleted' => 0,
                    ]
                );
            
                $userId = $user->id;
            }
          
               
            $bookingDate = Carbon::createFromFormat('Y-m-d H:i:s', $data['booking_date'])->format('Y-m-d H:i:s');
            $bookingNumber = Booking::generateNoBooking($bookingDate);

            $Booking = new Booking;
            $Booking->booking_date = $bookingDate;
            $Booking->no_booking = $bookingNumber;
            $Booking->id_customer = $userId;
            $Booking->id_service_category = 8; //non paket
            $Booking->status = 0;
            $Booking->type = 1;
            $Booking->discount = 0;
          

            // hitung price service
            $idServices = Arr::pluck($data['booking_details'], 'id_service');
            $totalPrice = DB::table('services')
                ->whereIn('id', $idServices)
                ->sum('price');
            
                $totalDuration = DB::table('services')
            ->whereIn('id', $idServices)
            ->sum('duration');
            
            $totalHourDuration=($totalDuration/60);

            $EstimateDuration = Carbon::createFromFormat('Y-m-d H:i:s', $data['booking_date'])
            ->addHours($totalHourDuration)
            ->format('Y-m-d H:i:s');

            // hitung product
            // dd($data['booking_products']);
            $totalPricex = 0;
            if (!empty($data['booking_products'])) {
                foreach ($data['booking_products'] as $bookingProduct) {
                    $idProduct = $bookingProduct['id_product'];
                    $quantity = $bookingProduct['qty'];
            
                    $price = DB::table('products')
                        ->where('id', $idProduct)
                        ->value('price');
            
                    $totalPricex += $price * $quantity;
                }
            }
        
            
            $Booking->total_price = $totalPrice+$totalPricex;
            $Booking->estimate_end = $EstimateDuration;
            $Booking->save();


            $bookingDetails = [];
            foreach ($data['booking_details'] as $bookingDetail) {
                $bookingDetails[] = new BookingDetail([
                    'id_booking' => $Booking->id,
                    'id_service' => $bookingDetail['id_service'],
                    'id_employee' => $bookingDetail['id_employee'],
                    'is_finish' => 0,
                ]);
            }
            $Booking->bookingDetails()->saveMany($bookingDetails);
       
            if(!empty($data['booking_products'])){
                $bookingProducts = [];
                $product = Product::find($bookingProduct['id_product']);

                // Mengurangi kuantitas produk
                $stockres = $product->stock - $bookingProduct['qty'];

                if ($stockres < 0) {
                    // Tindakan jika stok habis
                    throw new \Exception("The " . $product->name ."  product is out of stock.");
                }
                
                $product->stock = $stockres;
                $product->save();

                foreach ($data['booking_products'] as $bookingProduct) {
                    $bookingProducts[] = new BookingProduct([
                        'id_booking' => $Booking->id,
                        'id_product' => $bookingProduct['id_product'],
                        'quantity' => $bookingProduct['qty'],
                    ]);
                }
                $Booking->bookingProducts()->saveMany($bookingProducts );
            }

            // Commit transaksi jika semua operasi berhasil
            DB::commit();
            
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Booking created successfully.',
                'data' => $bookingNumber,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            DB::rollback();
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }


    public function getlistproducts(Request $request)
    {
        try {
            // Ambil data dari permintaan AJAX (misalnya, parameter POST atau GET)
            // $data = $request->input('data');

            $query = "
                SELECT
                    *
                FROM
                    products bk
            ";
            
            

            $data = DB::select($query);

            // Contoh data yang dikirim sebagai respons JSON
            $responseData = [
                'code'=>0,
                'status' => 'success',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tangani di sini
            // Misalnya, tampilkan pesan error atau lakukan tindakan yang sesuai

            // Contoh menampilkan pesan error
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function createproduct(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                'price' => 'required|integer|gt:0',
                'stock' => 'required|integer|gt:0',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $Product = new Product;
            $Product->name = $data->name;
            $Product->stock = $data->stock;
            $Product->price = $data->price;
            $Product->save();

            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Product created successfully.',
                'data' => $data,
            ];

            return response()->json($responseData);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function updateproduct(Request $request)
    {
        try {
            // Validasi input
            $data = json_decode($request->getContent());

            $validator = Validator::make((array) $data, [
                'name' => 'required',
                'price' => 'required|integer|gt:0',
                'stock' => 'required|integer|gt:0',
            ]);

            if ($validator->fails()) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => $validator->errors()->all(),
                ];
                return response()->json($errorResponse, 422); // Kode status 422 untuk validasi gagal
            }

            $Product = Product::find($data->id);

            if (!$Product) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Product not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }

            // Update data user
            $Product->name = $data->name;
            $Product->stock = $data->stock;
            $Product->price = $data->price;
            $Product->save();

            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Product updated successfully.',
                'data' => $data,
            ];

            // Kembalikan data dalam format JSON
            return response()->json($responseData);

        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function deleteproduct(Request $request)
    {
        try {
            $data = json_decode($request->getContent());
    
            // Cari pengguna berdasarkan ID
            $Product = Product::find($data->id);
    
            if (!$Product) {
                $errorResponse = [
                    'status' => 'error',
                    'message' => 'Product not found.',
                ];
                return response()->json($errorResponse, 404); // Kode status 404 untuk data tidak ditemukan
            }
    
            // Hapus pengguna
            $Product->delete();
    
            $responseData = [
                'code' => 0,
                'status' => 'success',
                'message' => 'Product deleted successfully.',
                'data' => $data,
            ];
    
            // Kembalikan data dalam format JSON
            return response()->json($responseData);
    
        } catch (\Exception $e) {
            $errorResponse = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
    
            return response()->json($errorResponse, 500); // Kode status 500 untuk kesalahan server
        }
    }



}

