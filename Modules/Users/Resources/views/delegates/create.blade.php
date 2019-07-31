
<!-- Modal -->
<div  id="addDelegateModal"  class="modal fade" role="dialog">
    <div class="modal-lg modal-notify modal-info" role="document" style="width: auto; margin: 10%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="height: 50px; background-color: #057d54"
                 class="modal-header d-flex text-center justify-content-center">
                <p style="color: white" class="heading">
                    <strong>{{ __('users::delegates.add_delegate') }}</strong>

                </p>
                <div class="clearfix"></div>

            </div>
            {{ Form::open(['route' => 'delegates.store', 'method' => 'POST', 'id' => 'delegate-form-create']) }}
            {{--{{ Form::open(['id' => 'delegate-form']) }}--}}


            <div class="modal-body" >

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('users::delegates.form')
                </div>

            </div>
            <div class="modal-footer" style="text-align: center">
                <input class="btn btn-lg blue" type="submit" value="{{__('users::delegates.action_add')}}">
                {{--{{ Form::button(__('users::delegates.action_add'), ['type' => 'button','id'=>'btn-save', 'class' => 'btn blue']) }}--}}

                <button  type="button" class="btn btn-lg btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>

            </div>

            {{ Form::hidden('committee_id', $committee->id) }}
            {{ Form::close() }}
        </div>

    </div>
</div>



