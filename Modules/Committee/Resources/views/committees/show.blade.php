@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.information') }}</span>
            </div>
            
            <div class="actions">
                @if(auth()->user()->hasPermissionWithAccess('edit'))
                    <a href="{{ route('committees.edit', $committee) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i> {{ __('committee::committees.edit') }}
                    </a>
                @endif
            </div>
        
        </div>

        <div class="portlet-body form">
            {{-- Treatment Info Table --}}
            <p class="underLine">{{ __('committee::committees.treatment information') }}</p>
            <table class="table table-striped table-responsive-md">
                <tbody>
                    <tr>
                        <th style="width: 16.66%" scope="row">رقم الطلب و تاريخه</th>
                        <td>
                            {{ __('committee::committees.committee uuid') }}
                            {{ $committee->uuid }}
                            {{ __('committee::committees.on_date') }}
                            {{ $committee->created_at_hijri }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">اعجلية المعاملة</th>
                        <td>
                            {{ $committee->treatmentUrgency->name }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">رقم المعاملة و وجهة طلب دراسة المعاملة</th>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">الجهة الموصية بدراسة المعاملة و رقمها</th>
                        <td>
                            {{ $committee->resourceDepartment->name }}
                            {{ __('committee::committees.with_number') }}
                            ({{ $committee->resource_staff_number }})
                            {{ __('committee::committees.on_date') }}
                            {{ $committee->resource_at_hijri }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">الموضوع</th>
                        <td>
                            {{ $committee->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">المهام</th>
                        <td>
                            {{ $committee->tasks }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">برئاسة</th>
                        <td>
                            {{ $committee->president ? $committee->president->name:'-'  }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">تاريخ الاجتماع و مقره</th>
                        <td>
                            {{ __('committee::committees.meeting in') }}
                            {{ __('messages.'.$committee->first_meeting_at->format('D')) }}
                            {{ __('committee::committees.on_date') }}
                            {{ $committee->first_meeting_at_hijri }}
                            {{ __('committee::committees.same as') }}
                            {{ $committee->first_meeting_at->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">المستشار المسؤول عن الدراسة و رقم التواصل</th>
                        <td>
                            {{ $committee->advisor->name  }}
                            <br />
                            {{ $committee->advisor->phone_number }}
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Participant Department --}}
            <p class="underLine">{{ __('committee::committees.treatment information') }}</p>
            <table class="table table-striped table-responsive-md">
                <thead>
                <tr>
                    <th style="width: 16.666%" scope="col"></th>
                    <th scope="col">الجهات المشاركة</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($committee->participantDepartments as $department)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                {{ $department->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection