@extends('layouts.dashboard.index')




    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.information') }}</span>
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
                        {{ $committee->resourceDepartment->name }}
                        {{ __('committee::committees.with_number') }}
                        ({{ $committee->treatment_number }})
                        {{ __('committee::committees.on_date') }}
                        {{ $committee->resource_at_hijri }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">الجهة الموصية بدراسة المعاملة و رقمها</th>
                    <td>
                        {{ $committee->recommendedByDepartment->name }}
                        {{ __('committee::committees.with_number') }}
                        ({{ $committee->recommendation_number }})
                        {{ __('committee::committees.on_date') }}
                        {{ $committee->recommended_at_hijri }}
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
                        {{ $committee->first_meeting_at->format('Y-m-d') }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">المستشار المسؤول عن الدراسة و رقم التواصل</th>
                    <td>
                        {{ $committee->advisor->name  }}
                        <br/>
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

            {{-- Participant Department --}}
            <p class="underLine">{{ __('committee::committees.files') }}</p>
            <table class="table table-striped table-responsive-md">
                <thead>
                <tr>
                    <th style="width: 16.666%" scope="col">رقم</th>
                    <th scope="col">وصف الملف</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($committee->documents as $document)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->description }}</td>
                        <td>
                            <a type="button" class="btn btn-default" href="{{ $document->full_path }}"
                               download>تحميل</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--@include('committee::delegates.nomination_departments',compact('committee'))
            @include('committee::delegates.committee_delegates',compact('committee'))--}}


        </div>
    </div>


