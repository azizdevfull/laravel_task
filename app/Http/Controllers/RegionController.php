<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionResource;
use App\Models\Region;
use App\Services\RegionService;
use Illuminate\Support\Facades\Cache;

class RegionController extends Controller
{
    public function __construct(protected RegionService $regionService)
    {
    }
    /**
     * @OA\Get(
     *     path="/api/regions",
     *     tags={"Regions"},
     *     summary="Get all regions with districts",
     *     description="Retrieves a list of all regions along with their associated districts.",
     *     @OA\Response(
     *         response=200,
     *         description="List of regions with districts",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example=null),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Region Name"),
     *                     @OA\Property(property="branches", type="integer", example=15),
     * 
     *                     @OA\Property(
     *                         property="districts",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="name", type="string", example="District Name"),
     *                             @OA\Property(property="branches", type="integer", example=10),
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function index()
    {
        $cacheKey = 'regions_with_districts_and_branches';

        $regions = Cache::rememberForever($cacheKey, function () {
            return Region::with('districts')->get();
        });
        return $regions;
        // return response()->success(RegionResource::collection(Cache::get($cacheKey)));
    }
}
