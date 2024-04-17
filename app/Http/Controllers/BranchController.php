<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Services\AttachmentService;
use App\Services\BranchService;

class BranchController extends Controller
{
    public function __construct(protected AttachmentService $attachmentService, protected BranchService $branchService)
    {
    }
    /**
     * @OA\Get(
     *     path="/api/branches",
     *     tags={"Branches"},
     *     summary="Get all branches",
     *     description="Retrieve a list of all branches with associated images.",
     *     @OA\Response(
     *         response=200,
     *         description="List of branches",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example=null),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Branch Name"),
     *                     @OA\Property(property="brand", type="string", example="Tech"),
     *                     @OA\Property(property="region", type="string", example="Tashkent"),
     *                     @OA\Property(property="district", type="string", example="Toshkent"),
     *                     @OA\Property(
     *                         property="images",
     *                         type="array",
     *                         @OA\Items(type="string", format="url", description="URLs of associated images")
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
        return $this->branchService->index();
    }

    /**
     * @OA\Post(
     *     path="/api/branches",
     *     tags={"Branches"},
     *     summary="Create a new branch with optional image uploads",
     *     description="Creates a new branch with specified details and optional images.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Branch data with optional image upload (multi-select)",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name", "brand_id", "region_id", "district_id"},
     *                 @OA\Property(property="name", type="string", example="Branch Name"),
     *                 @OA\Property(property="brand_id", type="integer", format="int64", example="1"),
     *                 @OA\Property(property="region_id", type="integer", format="int64", example="1"),
     *                 @OA\Property(property="district_id", type="integer", format="int64", example="15"),
     *                 @OA\Property(
     *                     property="images[]",
     *                     type="array",
     *                     @OA\Items(type="string", format="binary", description="Image file (JPEG, PNG, GIF)"),
     *                     description="Array of image files (JPEG, PNG, GIF) to upload"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Branch created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch created successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="Branch Name"),
     *                 @OA\Property(property="brand", type="string", example="Tech"),
     *                 @OA\Property(property="region", type="string", example="Tashkent"),
     *                 @OA\Property(property="district", type="string", example="Toshkent"),
     *                 @OA\Property(property="images", type="array",
     *                     @OA\Items(type="urls", format="url", description="URLs of uploaded images")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */

    public function store(StoreBranchRequest $request)
    {
        return $this->branchService->store($request);
    }

    /**
     * @OA\Get(
     *     path="/api/branches/{id}",
     *     tags={"Branches"},
     *     summary="Get a specific branch by ID",
     *     description="Retrieves details of a specific branch by its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Branch ID",
     *         @OA\Schema(type="integer", format="int64", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Branch details",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example=""),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Branch Name"),
     *                 @OA\Property(property="brand", type="string", example="Tech"),
     *                 @OA\Property(property="region", type="string", example="Tashkent"),
     *                 @OA\Property(property="district", type="string", example="Toshkent"),
     *                 @OA\Property(
     *                     property="images",
     *                     type="array",
     *                     @OA\Items(type="string", format="url", description="URLs of uploaded images")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Branch not found")
     * )
     */
    public function show(string $id)
    {
        return $this->branchService->show($id);
    }

    /**
     * @OA\Post(
     *     path="/api/branches/{id}",
     *     tags={"Branches"},
     *     summary="Update an existing branch",
     *     description="Updates an existing branch with specified details and optional image uploads.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Branch ID",
     *         @OA\Schema(type="integer", format="int64", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Branch data with optional image upload (multi-select)",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name", "brand_id", "region_id", "district_id"},
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="brand_id", type="integer", format="int64"),
     *                 @OA\Property(property="region_id", type="integer", format="int64"),
     *                 @OA\Property(property="district_id", type="integer", format="int64"),
     *                 @OA\Property(
     *                     property="images[]",
     *                     type="array",
     *                     @OA\Items(type="string", format="binary", description="Image file (JPEG, PNG, GIF)")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Branch updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="brand_id", type="integer", format="int64"),
     *                 @OA\Property(property="region_id", type="integer", format="int64"),
     *                 @OA\Property(property="district_id", type="integer", format="int64"),
     *                 @OA\Property(
     *                     property="images",
     *                     type="array",
     *                     @OA\Items(type="string", format="url", description="URLs of updated images")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Branch not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function update(UpdateBranchRequest $request, string $id)
    {
        return $this->branchService->update($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/branches/{id}",
     *     tags={"Branches"},
     *     summary="Delete a branch by ID",
     *     description="Deletes a branch and its associated images by its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Branch ID",
     *         @OA\Schema(type="integer", format="int64", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Branch deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Branch deleted successfully"),
     *             @OA\Property(property="data", type="string", example=null)
     *         )
     *     ),
     *     @OA\Response(response=404, description="Branch not found"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function destroy(string $id)
    {
        return $this->branchService->destroy($id);
    }
}
