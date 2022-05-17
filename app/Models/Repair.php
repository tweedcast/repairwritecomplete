<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function location()
    {
      return $this->belongsTo(Location::class);
    }

    public function files()
    {
      return $this->hasMany(File::class);
    }

    public function lines()
    {
      return $this->hasMany(Line::class);
    }

    public function labor_rates()
    {
      return $this->hasMany(LaborRate::class);
    }

    public function material_rates()
    {
      return $this->hasMany(MaterialRate::class);
    }

    public function subtotals()
    {
      return $this->hasMany(Subtotal::class);
    }

    public function totals()
    {
      return $this->hasMany(Total::class);
    }
}
