<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function users()
    {
      return $this->hasMany(User::class);
    }

    public function locations()
    {
      return $this->hasMany(Location::class);
    }

    public function admin_users()
    {
      return $this->hasMany(User::class)->get()->filter(function($user){ return $user->isAdmin(); });
    }

    public function default_users()
    {
      return $this->hasMany(User::class)->get()->filter(function($user){ return !$user->isAdmin(); });
    }


}
