<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
        'application_number' => $this->application_number,
        'full_name' => $this->full_name,
        'phone' => $this->phone,
        'school' => $this->school,
        //'qualification' => $this->qualification,
        'status' => $this->status,
        'submitted_at' => $this->submitted_at,
        'created_at' => $this->created_at,
    ];
}
}
