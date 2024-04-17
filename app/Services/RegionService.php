<?php

namespace App\Services;

use App\Http\Resources\RegionResource;
use App\Models\Region;

class RegionService
{
    public function index()
    {
        return RegionResource::collection(Region::with('districts')->get());
    }
}
