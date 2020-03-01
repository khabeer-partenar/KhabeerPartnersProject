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

            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#btnAddMedia').click(function () {
            $html = '{{ Form::textarea('text[]', null, ['maxlength' => 191, 'rows' => 2, 'cols' => 54,'style'=>'width:100%'])}}';
            $html +='<hr style="margin-top: 5px;margin-bottom: 5px">';
            $('#btnAddMedia').before($html);
        });
    </script>
@endsection