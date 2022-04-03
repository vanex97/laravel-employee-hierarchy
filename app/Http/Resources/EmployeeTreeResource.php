<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeTreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $this->image->url,
            'parentId' => $this->head_id,
            'position' => $this->position->name,
            'profileUrl' => route('employees.show', $this)
        ];
    }
}
