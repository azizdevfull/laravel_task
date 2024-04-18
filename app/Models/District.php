<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
