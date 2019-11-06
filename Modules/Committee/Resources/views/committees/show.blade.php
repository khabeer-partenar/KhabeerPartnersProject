@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.information') }}</span>
            </div>
            <div class="actions" style="margin-right: 10px">
                @if(auth()->user()->hasPermissionWithAccess('edit'))
                    <a href="{{ route('committees.edit', $committee) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i> {{ __('committee::committees.edit') }}
                    </a>
                @endif
            </div>
            <div class="actions">
                    <a onclick="window.print();" class="btn btn-sm btn-primary">
                        <i class="fa fa-file-pdf-o"></i> {{ __('committee::committees.committee_export') }}
                    </a>
            </div>
        
        </div>

        <div class="portlet-body form">
            {{-- Treatment Info Table --}}
            <label class="underLine">{{ __('committee::committees.treatment information') }}</label>
            <table class="table table-striped table-responsive-md">
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
                            {{ $committee->SourceOfStudy->name }}
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

            <br />

            {{-- Participant Department --}}
            <label class="underLine">{{ __('committee::committees.treatment information') }}</label>
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

            <br />

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
                            <a type="button" class="btn btn-default" href="{{ $document->full_path }}" download>تحميل</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br />

            @include('committee::delegates.nomination_departments',compact('committee'))

            <br />

            @include('committee::delegates.committee_delegates',compact('committee'))
        </div>
    </div>

@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
    @include('users::delegates.scripts')
@endsection