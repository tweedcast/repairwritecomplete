<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCCOption extends Model
{
    use HasFactory;

    protected $table = 'ccc_options';
    protected $connection= 'mysql2';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function opt_group()
    {
        return $this->belongsTo(CCCOptGrp::class, 'grp_id', 'grp_id');
    }
}
