<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\AttachmentService;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService)
    {
    }
    /**
     * @OA\Get(
     *     path="/api/brands",
     *     tags={"Brands"},
     *     summary="Get all brands",
     *     @OA\Response(
     *         response=200,
     *         description="List of brands",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example=null),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Tenomart"),
     *                 @OA\Property(property="image", type="string", example="url"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T09:53:02.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T11:10:21.000000Z")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return $this->brandService->index();
    }
    /**
     * @OA\Post(
     *     path="/api/brands",
     *     tags={"Brands"},
     *     summary="Create a new brand",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Brand data with optional image upload",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     description="Brand name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     description="Image file to upload",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Brand created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example="1"),
     *             @OA\Property(property="name", type="string", example="Example Brand"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time"),
     *             @OA\Property(property="image_url", type="string", nullable=true, example="http://example.com/image.jpg")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */

    public function store(StoreBrandRequest $request)
    {
        return $this->brandService->store($request);
    }
    /**
     * @OA\Get(
     *     path="/api/brands/{id}",
     *     tags={"Brands"},
     *     summary="Get a specific brand by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Brand ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand details",
     *        @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example=null),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Techno"),
     *                 @OA\Property(property="image", type="string", example="url"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-17T09:53:02.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-17T11:10:21.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function show($id)
    {
        return $this->brandService->show($id);
    }

    /**
     * @OA\Post(
     *     path="/api/brands/{id}",
     *     tags={"Brands"},
     *     summary="Update an existing brand by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Brand ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Brand data with optional image upload",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     description="Brand name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     description="Image file to upload",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Brand updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="New Brand Name"),
     *                 @OA\Property(property="image", type="string", example="url"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="image_url", type="string", nullable=true, example="http://example.com/new_image.jpg")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Brand not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        return $this->brandService->update($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/brands/{id}",
     *     tags={"Brands"},
     *     summary="Delete a brand by ID",
     *     description="Deletes a brand along with its associated images, if any.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Brand ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Brand deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Brand deleted successfully"),
     *             @OA\Property(property="data", type="string", example=null)
     *         )
     *     ),
     *     @OA\Response(response=404, description="Brand not found"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function destroy($id)
    {
        return $this->brandService->destroy($id);
    }
}
