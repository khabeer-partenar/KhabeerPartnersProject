@extends('email.layout')

@section('content')
    <h4>
        @if($meeting->type_id == \Modules\Committee\Entities\Meeting::FIRST)
            {{ __('committee::notifications.cancel_first_meeting', ['number' => $committee->resource_staff_number, 'date' => $meeting->meeting_at, 'hall'=> $meeting->room->name, 'day' => $day]) }}
        @elseif($meeting->type_id == \Modules\Committee\Entities\Meeting::COMPLEMENTARY)
            {{ __('committee::notifications.cancel_complmentary_meeting', ['number' => $committee->resource_staff_number, 'date' => $meeting->meeting_at, 'hall'=> $meeting->room->name, 'day' => $day]) }}
        @endif
    </h4>
    <a target="_blank" href="{{ route('committee.meetings.show', compact('committee','meeting')) }}" class="btn btn-green no-decoration">
        {{ route('committee.meetings.show', compact('committee','meeting')) }}
    </a>
@endsection

