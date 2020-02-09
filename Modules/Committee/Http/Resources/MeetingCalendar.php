<?php

namespace Modules\Committee\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Committee\Http\Resources\MeetingType as TypeResource;
use Modules\Committee\Http\Resources\MeetingAdvisor as AdvisorResource;
use Modules\Committee\Http\Resources\MeetingRoom as RoomResource;


class MeetingCalendar extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {    
        $type = new TypeResource($this->type);
        $advisor = new AdvisorResource($this->advisor);
        $room = new RoomResource($this->room);
        $counter = $this->withCount(['attendingDelegates', 'attendingAdvisors','absentDelegates','absentAdvisors'])->get();
        return[
            'title' => $this->reason,
            'meetingType' => $type->name,
            'start' => $this->from_date,
            'end' => $this->to_date,
            'color' => $type->color,
            'meetingChair' => $advisor->name,
            'place' => $room->name,
            'attendaceNumber' => $counter[0]->attending_delegates_count +  $counter[0]->attending_advisors_count,
            'absenceNumber' =>$counter[0]->absent_delegates_count +  $counter[0]->absent_advisors_count,
        ];
    }
}