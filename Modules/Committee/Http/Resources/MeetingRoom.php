<?php

namespace Modules\Committee\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingRoom extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {    
        return[
            'name' => $this->name,
            'color' => $this->color,
        ];
    }
}
