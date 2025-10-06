<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'trucker_id' => $this->trucker_id,
            'address' => $this->address,
            'status' => $this->whenLoaded('packageStatus', function () {
                return $this->packageStatus->status;
            }),
            'details' => $this->whenLoaded('details', function () {
                return [
                    'dimensions' => $this->details->first()->dimensions,
                    'weight' => $this->details->first()->weight,
                    'merchandise' => $this->details->first()->merchandiseType->type,
                ];
            }),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
