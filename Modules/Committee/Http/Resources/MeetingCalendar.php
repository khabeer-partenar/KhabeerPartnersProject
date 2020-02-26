<?php

namespace Modules\Committee\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Committee\Http\Resources\MeetingType as TypeResource;
use Modules\Committee\Http\Resources\MeetingAdvisor as AdvisorResource;
use Modules\Committee\Http\Resources\MeetingRoom as RoomResource;
use Auth;


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
        if(auth()->user()->user_type == \Modules\Users\Entities\Delegate::TYPE)
            $url = route('committees.meetings.delegate.show', [$this->committee, $this]);
        elseif(auth()->user()->user_type == \Modules\Users\Entities\Coordinator::TYPE)
            $url = route('committees.meetings.co.show', [$this->committee, $this]);
        else
            $url = route('committee.meetings.show', [$this->committee, $this]);
        return[
            'title' => $this->reason,
            'meetingType' => $type->name,
            'start' => $this->from_date,
            'end' => $this->to_date,
            'color' => $type->color,
            'meetingChair' => $advisor->name,
            'place' => $room->name,
            'attendaceNumber' => $this->attendingDelegates->count() +  $this->attendingAdvisors->count(),
            'absenceNumber' =>$this->absentDelegates->count() +  $this->absentAdvisors->count(),
            'meetingId' => $this->id,
            'meetingUrl' => $url,
            'advisorId' => $advisor->id,
            'userId' => Auth::user()->id,
        ];
    }
}
