<div   id="addDelegateModal"  class="modal fade" role="dialog">
    <div  class="modal-lg modal-notify modal-info" role="document" style="width: auto; margin: 10%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div id="loadingSpinner" style="display:none; position: fixed; z-index: 1031;top: 50%;right: 50%">
                <span  class="fa fa-spinner fa-spin fa-5x"></span>
            </div>
            <div style="height: 50px; background-color: #057d54"
                 class="modal-header d-flex text-center justify-content-center">
                <p style="color: white" class="heading">
                    <strong>{{ __('users::delegates.add_delegate') }}</strong>

                </p>
                <div class="clearfix"></div>

            </div>
            {{-- {{ Form::open(['route' => 'delegates.store', 'method' => 'POST', 'id' => 'delegate-form-create']) }} --}}
            {{--{{ Form::open(['id' => 'delegate-form']) }}--}}


            <div class="modal-body" >

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    {{-- @include('users::delegates.form_popup') --}}
                </div>
                <div class="row">

    <div class="col-md-4">
        <div id="div_email" class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            {!! Form::label('email', 'البريد الإلكتروني', ['class' => 'control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form_control']) !!}

                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_title" class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

            {!! Form::label('title', 'اللقب', ['class' => 'control-label']) !!}

                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form_control']) !!}

                @if ($errors->has('title'))
                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                @endif

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_job_role_id" class="form-group ">


                <select id="job_role_id" class="form_control select2" name="job_role_id" disabled>
                   
                    
                        <option value=""
                                data-main="">
                            ''
                        </option>
                   
                </select>

                @if ($errors->has('job_role_id'))
                    <span class="help-block"><strong>{{ $errors->first('job_role_id') }}</strong></span>
                @endif

        </div>
    </div>

</div>

            </div>
            
            <div class="modal-footer">
                <button class="btn blue" type="submit" >{{__('users::delegates.action_add')}}</button>
                {{--{{ Form::button(__('users::delegates.action_add'), ['type' => 'button','id'=>'btn-save', 'class' => 'btn blue']) }}--}}

                <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>

            </div>

            {{-- {{ Form::hidden('committee_id', $committee->id) }}
            {{ Form::close() }} --}}
        </div>

    </div>
</div>
