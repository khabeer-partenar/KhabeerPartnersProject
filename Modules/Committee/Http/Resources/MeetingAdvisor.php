<?php

namespace Modules\Committee\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingAdvisor extends JsonResource
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
        ];
    }
}
