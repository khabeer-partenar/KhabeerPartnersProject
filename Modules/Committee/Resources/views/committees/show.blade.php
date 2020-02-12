@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-7">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.information') }}</span>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="actions item-fl item-mb20">

                        @if(auth()->user()->hasPermissionWithAccess('edit') && !$committee->exported && $committee->can_take_action)
                            <a href="{{ route('committees.edit', $committee) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> {{ __('committee::committees.edit') }}
                            </a>
                        @endif

                        <a href="{{route('committee.export.all.info',$committee)}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-file-pdf-o"></i> {{ __('committee::committees.committee_export') }}
                        </a>
                    </div>
                    
                </div>

            </div>
            
        </div>

        <div class="portlet-body form">
            {{-- Treatment Info Table --}}
            <label class="underLine">{{ __('committee::committees.treatment information') }}</label>
            <table class="table table-striped table-responsive-md no-align">
                <tbody>
                    <tr>
                        <th style="width: 16.66%" scope="row">رقم الطلب و تاريخه</th>
                        <td>
                            {{ $committee->uuid }}
                            {{ __('committee::committees.on_date') }}
                            {{ $committee->created_at_hijri }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 16.66%" scope="row">جهة التوريد و رقم وارد الهيئة</th>
                        <td>
                            {{ $committee->resourceDepartment->name }}
                            {{ __('committee::committees.with_number') }}
                            ({{ $committee->resource_staff_number }})
                            {{ __('committee::committees.on_date') }}
                            {{ $committee->resource_at_hijri }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 16.66%" scope="row">رقم وتاريخ صادر الجهة</th>
                        <td>
                            ({{ $committee->department_out_number }})
                            {{ __('committee::committees.on_date') }}
                            {{ $committee->department_out_date_hijri }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">رقم المعاملة و تاريخها</th>
                        <td>
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
                        <th scope="row">الجهة مصدر الدراسة</th>
                        <td>
                            {{ $committee->sourceOfStudy->name }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">نوع المعاملة</th>
                        <td>
                            {{ $committee->treatmentType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">سرية المعاملة</th>
                        <td>
                            {{ $committee->treatmentImportance->name }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">اعجلية المعاملة</th>
                        <td>
                            {{ $committee->treatmentUrgency->name }}
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
                            {{ __('committee::committees.hour') }}
                            {{ $committee->first_meeting_at->format('H:i') }}
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
                    <tr>
                        <th scope="row">السكرتير و رقم التواصل</th>
                        <td>
                            {{ $committee->creator->name }}
                            <br />
                            {{ $committee->creator->phone_number }}
                        </td>
                    </tr>
                    @if ($committee->participantAdvisors->count() > 0)
                        <tr>
                            <th scope="row">المستشارين المشاركين</th>
                            <td>
                                <ul>
                                @foreach($committee->participantAdvisors as $advisor)
                                    <li>
                                        {{ $advisor->name }}
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <th scope="row">عدد الأعضاء</th>
                        <td>{{ $committee->members_count }}</td>
                    </tr>
                </tbody>
            </table>

            <br /><br />

            {{-- Participant Department --}}
            <label class="underLine">جهات المعاملة</label>
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

            <br /><br />

            {{-- Participant Department --}}
            <label class="underLine">{{ __('committee::committees.files') }}</label>
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
                            <a type="button" class="btn btn-primary"
                               href="{{ route('committees.document.download', ['document' => $document]) }}"
                               download>تحميل</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br>

            @include('committee::delegates.nomination_departments',['committee'=>$committee,'report'=>false])
            @include('committee::delegates.committee_delegates',['committee'=>$committee,'report'=>false])

            <br>
            @if(
                auth()->user()->hasPermissionWithAccess('approve','CommitteeController','Committee')
                &&
                ($committee->advisor_id == auth()->id() || auth()->user()->is_super_admin)
                &&
                !$committee->approved
            )
                <a id="btn-approve" style="float: right;background-color: #057d54" class="btn btn-sm btn-info">
                    <i class="fa fa-check"></i> {{ __('committee::committees.approve') }}
                </a>
            @endif
            @if(
                auth()->user()->hasPermissionWithAccess('export')
                &&
                ($committee->advisor_id == auth()->id() || auth()->user()->is_super_admin)
                &&
                $committee->approved
                &&
                !$committee->exported
            )
                <form method="post" action="{{ route('committees.export', compact('committee')) }}">
                    @csrf
                    <button id="btn btn-primary" type="submit" style="float: right" class="btn btn-sm btn-info">
                        <i class="fa fa-check"></i> {{ __('committee::committees.export') }}
                    </button>
                </form>
            @endif
        </div>
    </div>

@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
    @include('users::delegates.scripts')
@endsection