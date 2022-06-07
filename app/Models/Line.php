<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['labor', 'refinish', 'part', 'charges', 'suggestions', 'modifications'];

    public function labor()
    {
      return $this->hasOne(LaborInfo::class);
    }

    public function refinish()
    {
      return $this->hasOne(RefinishLaborInfo::class);
    }

    public function part()
    {
      return $this->hasOne(PartInfo::class);
    }

    public function charges()
    {
      return $this->hasOne(OtherChargesInfo::class);
    }

    public function suggestions()
    {
      return $this->hasMany(LineSuggestion::class);
    }

    public function modifications()
    {
      return $this->hasMany(LineModification::class);
    }
}
