<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'welcomed_at' => $this->welcomed_at?->format('d M Y'),
            'visitor' => UserResource::make($this->whenLoaded('visitor')),
            'occupancy' => OccupancyResource::make($this->whenLoaded('occupancy')),
        ];
    }
}
