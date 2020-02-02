<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Kid extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'department_id' => $this->department_id,
            'parent' => $this->user->first_name . ' ' . $this->user->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'image_url' => $this->image['path'],
            'is_present' => $this->is_present,
            'messages' => $this->messages,
        ];
    }
}
