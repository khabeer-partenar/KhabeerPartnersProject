@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                         <span class="caption-subject sbold">{{ __('committee::committees.meetings_attendance') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committees.index') }}"
                           class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search Form --}}
        <div class="row">
            <form class="" method="get" action="{{ route('committees.attendance', compact('committee')) }}">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="department_id" class="control-label">اسم الجهة</label>
                        <select name="department_id" id="department_id" class="form_control select2">
                            <option value="0" selected>{{ __('committee::committees.attendance_all') }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ \Request::get('department_id') == $department->id ? 'selected':'' }}>
                                    {{ $department->name . ($department->referenceDepartment ? ' - ' .$department->referenceDepartment->name:'') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="department_type">نوع الإجتماع</label>
                        <select name="type_id" id="type_id" class="form_control select2">
                            <option value="0" selected>{{ __('committee::committees.attendance_all') }}</option>
                            @foreach($types as $key => $name)
                                <option value="{{ $key }}" {{ \Request::get('type_id') == $key ? 'selected':'' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="attended">حالة الحضور</label>
                        <select name="attended" id="attended" class="form_control select2">
                            <option value="-1" {{ request()->get('attended') == 'all' ? 'selected':'' }}>{{ __('committee::committees.attendance_all') }}</option>
                            @foreach(\Modules\Committee\Entities\MeetingDelegate::attendingStatus as $key => $attendingStatus)
                                <option value="{{ $key }}" {{ request()->get('attended') == $key ? ' selected':'' }}>{{ __('committee::committees.attendance_'.$attendingStatus) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary_s search-table">بحث</button>
                </div>


            </form>
        </div>

        <div class="portlet-body form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%" class="table table-bordered">
                            <thead>
                            <tr style="font-weight:bold">
                                <th style="width:7%" scope="col">
                                    <input type="checkbox" id="checkAllDelegates" class="checkInContainer" data-container="#delegatesDiv">
                                </th>
                                <th scope="col">نوع الإجتماع
                                    <br> تاريخ الإجتماع
                                </th>
                                <th scope="col">حالة الدعوة</th>
                                <th scope="col">حالة الحضور</th>
                                <th scope="col">اسم المندوب</th>
                                <th scope="col">الجهة</th>
                                <th scope="col">سبب الإعتذار</th>
                            </tr>
                            </thead>
                            <tbody id="delegatesDiv" class="containerUnCheckAll" data-checker="#checkAllDelegates">
                            @if (count($committee->meetings) == 0)
                                <tr>
                                    <td colspan="7"><center>لا يوجد بيانات</center></td>
                                </tr>
                            @endif
                            @foreach($committee->meetings as $meeting)
                                @foreach($meeting->delegates as $delegate)
                                    <tr>
                                        <td>
                                            <div class="form-group {{ $errors->has('delegates.*') ? ' has-error' : '' }}">
                                                <input type="checkbox"
                                                       name="delegates[]"
                                                       value="{{ $delegate->id }}"
                                                >
                                            </div>
                                        </td>
                                        <td>
                                            {{ $meeting->type->name }}
                                            <br>
                                            {{ $meeting->meeting_at }}
                                        </td>
                                        <td>
                                            {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                        </td>
                                        <td>
                                            @if (is_null($delegate->pivot->attended))
                                                {{ '-' }}
                                            @else
                                                {{ $delegate->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent') }}
                                            @endif
                                        </td>
                                        <td>
                                            <span title="{{ $delegate->phone_number }}">{{ $delegate->name }}</span>
                                        </td>
                                        <td>{{ $delegate->department->name }}</td>
                                        <td>
                                            {{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ? $delegate->pivot->refuse_reason:'' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('scripts_2')
    @include('committee::meetings.scripts')
@endsection