@if (isset($delegates))

    <div class="portlet light bordered" id="source-html">
            <form action="{{ route('committee.meetings.multimedia.exportWord') }}" method="POST">
                    @csrf
        <div class="portlet-body form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%" class="table table-bordered" id="Table1">
                            <thead>
                            <tr style="font-weight:bold">
                                <th style="width:7%" scope="col">
                            <input type="checkbox" id="checkAllMultimedia" class="checkInContainer" data-container="#multimediaDiv">
                                </th>
                                <th scope="col">معلومات المشارك</th>
                                <th scope="col" width="40%">مرئيات الإجتماع</th>
                                <th scope="col">المرفقات</th>
                            </tr>
                            </thead>
                            <tbody id="multimediaDiv" class="containerUnCheckAll" data-checker="#checkAllMultimedia">
                            @foreach($meeting->delegates as $delegate)
                                <tr>
                                    <td>
                                    <input type="checkbox"
                                    name="delegates[]"
                                    value="{{ $delegate->id }}">
                                    </td>
                                    <td>{{ $delegate->name . ' - ' . $delegate->department->name }}</td>
                                    <td>
                                        @foreach($delegate->multimedia as $multimedia)
                                            <div class="col-md-12">
                                                <textarea class="form-control" style="width: 100%"
                                                      disabled>{{ $multimedia->text }}</textarea>
                                                <p> {{__('committee::delegate_meeting.multimedia_date') . ' : ' . $multimedia->updated_at}}</p>
                                                <hr style="margin-top: 5px;margin-bottom: 5px">
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($delegate->documents as $document)
                                            <div>
                                                {{ $document->description ? $document->description:''}} ...
                                                <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="actions item-fl item-mb20">
                <button class="btn item-mt20" type="submit" href="{{ route('committee.meetings.multimedia.exportWord', \Request::all()) }}">{{ __('messages.print') }}</button>
                <a class="btn item-mt20 word-export" type="button" name="submit" href="" id="btn-export" onclick="exportHTML();">{{ __('messages.export') }}</a>
                {{-- <button class="btn item-mt20" type="button" href="{{ route('committee.meetings.multimedia.exportWord') }}">{{ __('messages.export') }}</button> --}}
            </div>
        </div>
    </form>

    </div>
@endif
@section('scripts')
@endsection
