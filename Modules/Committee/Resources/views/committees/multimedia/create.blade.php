@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-7">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.my_multimedia') }}</span>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body form">

                <br>

                @if(!$committee->exported)
                    <form method="post" action="{{ route('committee.multimedia.store', compact('committee')) }}">
                    @csrf
                @endif
                    <div id="multimedia" style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
                        @foreach($committee->multimedia as $multimedia)

                            {{ Form::textarea(null, $multimedia->text, ['id' => 'text'.$multimedia->id , 'rows' => 2, 'cols' => 54, 'style'=>'width:100%']) }}

                            <label> {{__('committee::delegate_meeting.multimedia_date') . ' : ' . $multimedia->updated_at}}</label>

                            <hr style="margin-top: 5px;margin-bottom: 5px">

                        @endforeach

                        @if(!$committee->exported)
                            <a id="btnAddMedia" class="btn btn-success">{{ __('committee::delegate_meeting.add_multimedia') }}</a>
                        @endif
                    </div>

                    @if(!$committee->exported)
                        <div class="row">
                            <div class="form-actions">
                                {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue item-fl item-mt20', 'id' => 'save-delegate-meeting']) }}
                            </div>
                        </div>
                    @endif

                    <p class="underLine">{{ __('committee::committees.upload_files') }}</p>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-4">
                                {!! Form::label('tasks',  __('committee::committees.file description'), ['class' => 'control-label']) !!}
                            </div>

                            <div class="col-md-8">
                                {!! Form::text('file_description', null, ['id' => 'file_description', 'class' => 'form_control']) !!}
                            </div>
                        </div>

                        <br><br>

                        <div class="col-md-5">
                            <div class="col-md-3">
                                <label>
                                    <button type="button" id="upload-file" class="btn btn-warning">
                                        رفع
                                    </button>
                                </label>
                            </div>
                            <div class="col-md-9">
                                <span id="fileName"></span>
                                <div class="hidden">
                                    <input type="file" name="uploadedFile" id="upload-file-browse">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="button" data-order="{{ $committee->documents()->count() }}" class="btn btn-primary" id="saveFiles"
                                    data-url="{{ route('committee.document.store-delegate', ['commiteee' => $committee]) }}">إضافة</button>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered mt-10">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('committee::committees.number') }}</th>
                                        <th scope="col">{{ __('committee::committees.file description') }}</th>
                                        <th scope="col">{{ __('committee::committees.file path') }}</th>
                                        <th scope="col">{{ __('committee::committees.options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="files">
                                        @foreach($committee->documents as $document)
                                            <tr id="file-{{ $document->id }}">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $document->description ? $document->description:''}}</td>
                                                <td>
                                                    <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger file-remove"
                                                            data-remove-url="{{ route('committee.document.delete-delegate', compact('committee', 'document')) }}"
                                                            data-remove-row="#file-{{ $document->id }}">
                                                        حذف
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

            </form>

        </div>
    </div>
@endsection

@section('scripts')
    @include('committee::committees.scripts')
    <script>
        $('#btnAddMedia').click(function () {
            $html = '{{ Form::textarea('text[]', null, ['maxlength' => 191, 'rows' => 2, 'cols' => 54,'style'=>'width:100%'])}}';
            $html +='<hr style="margin-top: 5px;margin-bottom: 5px">';
            $('#btnAddMedia').before($html);
        });
    </script>
@endsection