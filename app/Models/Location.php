<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function users()
    {
      return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function organization()
    {
      return $this->belongsTo(Organization::class);
    }

    public function curr_users()
    {
      return $this->hasMany(User::class, 'curr_location_id');
    }

    public function repairs()
    {
      return $this->hasMany(Repair::class);
    }
}
