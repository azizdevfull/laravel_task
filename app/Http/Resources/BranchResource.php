<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = $this->images->map(fn ($image) => $image->url);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand->name,
            'region' => $this->region->name,
            'district' => $this->district->name,
            'images' => $images,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
