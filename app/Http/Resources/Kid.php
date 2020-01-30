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
            'name' => $this->name,
            'image_url' => $this->image['path'],
            'is_present' => $this->is_present,
            'messages' => $this->messages,
        ];
    }
}
