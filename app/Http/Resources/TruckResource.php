<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class TruckResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plate' => $this->plate,
            'model' => $this->model,
            'capacity' => $this->capacity,
        ];
    }
}
