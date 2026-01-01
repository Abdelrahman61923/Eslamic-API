<?php

namespace App\Http\Resources;

use App\Models\Ayah;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
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
            'number' => $this->number,
            'name' => $this->name,
            'url' => $this->url,
            'revelation_type' => $this->revelation_type == 'Meccan' ? 'مكيه' : 'مدنيه',
            'numberOfAyahs' => $this->ayahs()->count(),
            'ayahs' => AyahResource::collection($this->whenLoaded('ayahs'))
        ];
    }
}
