<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCCVehicle extends Model
{
    use HasFactory;

    protected $table = 'ccc_vehicles';
    protected $connection= 'mysql2';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}