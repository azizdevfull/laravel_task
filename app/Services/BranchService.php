<?php

namespace App\Services;

use App\Events\AttachmentEvent;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Services\AttachmentService;

class BranchService
{
    public function __construct(protected AttachmentService $attachmentService)
    {
    }
    public function index()
    {
        return response()->success(BranchResource::collection(Branch::with('images')->get()));
    }

    public function store($request)
    {
        $branch = new Branch;
        $branch->name = $request->name;
        $branch->brand_id = $request->brand_id;
        $branch->region_id = $request->region_id;
        $branch->district_id = $request->district_id;
        $branch->save();
        if ($request->hasFile('images')) {
            event(new AttachmentEvent($request->images, $branch->images()));
        }

        return response()->success(new BranchResource($branch->load('images')), 'Brand created successfully', 201);
    }

    public function show($id)
    {
        return response()->success(new BranchResource(Branch::with('images')->findOrFail($id)));
    }

    public function update($request, string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->name = $request->name;
        $branch->brand_id = $request->brand_id;
        $branch->region_id = $request->region_id;
        $branch->district_id = $request->district_id;
        $branch->save();
        if ($request->hasFile('images')) {
            if ($branch->images()->first()) {
                $this->attachmentService->destroy($branch->images);
                $branch->images()->delete();
            }
            event(new AttachmentEvent($request->images, $branch->images()));
        }
        return response()->success(new BranchResource($branch->load('images')), 'Branch updated successfully', 200);
    }

    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        if ($branch->images()->first()) {
            $this->attachmentService->destroy($branch->images);
            $branch->images()->delete();
        }
        $branch->delete();
        return response()->success(null, 'Branch deleted successfully', 200);
    }
}
