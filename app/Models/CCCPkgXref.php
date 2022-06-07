<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCCPkgXref extends Model
{
    use HasFactory;

    protected $table = 'ccc_pkg_xrefs';
    protected $connection= 'mysql2';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
