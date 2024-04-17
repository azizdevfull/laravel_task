<?php

namespace App\Models;

use App\Models\Attachment;
use App\Models\Brand;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand_id', 'region_id', 'district_id'];

    public function images()
    {
        return $this->morphMany(Attachment::class, 'attachment');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
