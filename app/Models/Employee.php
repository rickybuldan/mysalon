<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function services()
    {
        return $this->belongsToMany(Service::class, 'employee_services', 'id_employee', 'id_service')->select('services.id');;
    }
}
