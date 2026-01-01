<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DuaResource extends JsonResource
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
            'dua' => $this->dua,
            'dua-category' => [
                'id' => $this->duaCategory->id,
                'name' => $this->duaCategory->name,
            ],
            'reference' => $this->reference,
            'order' => $this->order,
            'count' => $this->count,
        ];
    }
}
