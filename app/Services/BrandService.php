<?php

namespace App\Services;

use App\Events\AttachmentEvent;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\AttachmentService;

class BrandService
{
    public function __construct(protected AttachmentService $attachmentService)
    {
    }
    public function index()
    {
        return response()->success(BrandResource::collection(Brand::with('images')->get()));
    }

    public function store($request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->save();
        if ($request->hasFile('image')) {
            $data['images'] = $request->image;
            event(new AttachmentEvent($data, $brand->images()));
        }

        return response()->success(new BrandResource($brand->load('images')), 'Brand created successfully', 201);
    }

    public function show($id)
    {
        return response()->success(new BrandResource(Brand::with('images')->findOrFail($id)));
    }

    public function update($request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->update();
        if ($request->hasFile('image')) {
            if ($brand->images()->first()) {
                $this->attachmentService->destroy($brand->images);
                $brand->images()->delete();
            }
            $data['images'] = $request->image;
            event(new AttachmentEvent($data, $brand->images()));
        }

        return response()->success(new BrandResource($brand->load('images')), 'Brand updated successfully', 200);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->images()->first()) {
            $this->attachmentService->destroy($brand->images);
            $brand->images()->delete();
        }
        $brand->delete();
        return response()->success(null, 'Brand deleted successfully', 200);
    }
}
