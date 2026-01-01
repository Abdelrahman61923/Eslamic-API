<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AyahResource extends JsonResource
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
            'number_in_surah' => $this->number_in_surah,
            'ayah' => $this->ayah,
            'juz' => $this->juz,
            'page' => $this->page,
            'hizb_quarter' => $this->hizb_quarter,
            'sajda' => $this->sajda,
            'audio_128' => $this->audio_128,
        ];
    }
}
