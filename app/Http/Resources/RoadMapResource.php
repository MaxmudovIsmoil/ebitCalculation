<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoadMapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "instanceId" => $this->instanceId,
            "name" => $this->instance->name,
              'users' => json_encode($this->instanceUsers)
//            "users" => UserResource::collection($this->instanceUsers)
        ];
    }
}
