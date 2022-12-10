<?php

namespace App\Http\Resources;

use App\Models\Statistics;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Statistics
 */
class StatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tasks_count' => $this->tasks_count,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
