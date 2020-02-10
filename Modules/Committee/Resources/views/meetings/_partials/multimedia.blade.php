@if (isset($delegates))

    <div class="portlet light bordered">

        <div class="portlet-body form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%" class="table table-bordered">
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
                            @foreach($delegates as $delegate)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkInContainer">
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
                <a class="btn item-mt20" type="button" href="{{ route('committee.multimedia.export', \Request::all()) }}">{{ __('messages.print') }}</a>
                <button class="btn item-mt20" type="button">{{ __('messages.export') }}</button>
            </div>
        </div>
    </div>
@endif