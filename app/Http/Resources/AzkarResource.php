<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AzkarResource extends JsonResource
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
            'zekr' => $this->zekr,
            'zekr_category' => $this->whenLoaded('azkarCategory', function () {
                return [
                    'id' => $this->azkarCategory->id,
                    'name' => $this->azkarCategory->name,
                ];
            }),
            'fadl' => $this->description,
            'reference' => $this->reference,
            'order' => $this->order,
            'count' => $this->count,
        ];
    }
}
