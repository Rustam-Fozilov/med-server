<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'user' => $this->user,
            'specialization' => $this->specialization,
            'birth_year' => $this->birth_year,
            'experience' => $this->experience,
            'work_start_time' => $this->work_start_time,
            'work_end_time' => $this->work_end_time,
            'image' => $this->images[0]->url,
        ];
    }
}
