<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTotal extends Model
{
    use HasFactory;
    protected $table = 'subtotals';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
