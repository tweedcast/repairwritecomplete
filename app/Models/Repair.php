<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

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
      return $this->hasMany(LaborRate::class)->get()->groupBy('lbr_type');
    }

    public function material_rates()
    {
      return $this->hasMany(MaterialRate::class)->get()->groupBy('matl_type');
    }

    public function subtotals()
    {
      return $this->hasMany(Subtotal::class)->get()->groupBy('ttl_type');
    }

    public function totals()
    {
      return $this->hasMany(Total::class)->get()->groupBy('ttl_type');
    }

    public function tax_rate()
    {
      return $this->hasOne(TaxRate::class)->get()->groupBy('tax_type');
    }

    public function part_rates()
    {
      return $this->hasMany(PartRate::class)->get()->groupBy('part_type');
    }

    public function options()
    {
      return $this->hasMany(VehicleOption::class)->orderBy('display_order');
    }
}
