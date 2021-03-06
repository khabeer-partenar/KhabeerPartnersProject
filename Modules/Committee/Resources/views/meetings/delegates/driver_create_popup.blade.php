@csrf
<div   id="addDelegateModal"  class="modal fade" role="dialog">
    <div id="delegateModal"  class="modal-info" role="document" style="width: 50%; margin: 10% auto;;">
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
            <div class="modal-body" >
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif
                <div class="form-body">
                </div>
                <div class="row">
                <form id="addDriverForm">
                    <div class="col-md-6">
                        <div id="div_name" class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">اسم السائق ثلاثي</label>
                            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>
                            <input name="name" type="text" id="driver_name" value="" class="form_control">
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="div_national_id" class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">
                            {!! Form::label('national_id', ' رقم الهوية/الاقامة', ['class' => 'control-label']) !!}
                            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                                {!! Form::text('national_id', null, ['id' => 'driver_national_id', 'class' => 'form_control']) !!}

                                @if ($errors->has('national_id'))
                                    <span class="help-block"><strong>{{ $errors->first('national_id') }}</strong></span>
                                @endif

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="div_nationality" class="form-group {{ $errors->has('nationality') ? ' has-error' : '' }}">
                            <input name="delegate_id" type="hidden" value="{{Auth::user()->id}}">
                            <label for="nationality" class="control-label">
                                الجنسية
                                <span style="color: red">*</span>
                            </label>
                            <select name="nationality_id" id="driver_nationality_id" class="form_control">
                                <option value="">اختر جنسية السائق</option>
                                @foreach($nationalities as  $nationality)
                                <option value="{{ $nationality->id }}">
                                        {{ $nationality->name }}
                                </option>
                                @endforeach
                            </select>

                            @if ($errors->has('nationality_id'))
                                <span class="help-block"><strong>{{ $errors->first('nationality_id') }}</strong></span>
                            @endif
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div id="div_religion" class="form-group {{ $errors->has('religion') ? ' has-error' : '' }}">
                            {!! Form::label('religion', 'الديانة', ['class' => 'control-label']) !!}
                                <select name="religion_id" id="driver_religion_id"
                                        class="form_control  load-religion_id"
                                        >
                                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                                    @foreach($religions as $religion)
                                        <option value="{{ $religion->id }}">
                                            {{ $religion->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('religion'))
                                    <span class="help-block"><strong>{{ $errors->first('religion') }}</strong></span>
                                @endif
                        </div>
                    </div>
                </form>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-primary" id="saveDelegateDriver"
                            data-url="{{ route('meeting.delegate-driver.store-driver') }}">إضافة</button>
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>
            </div>

        </div>
    </div>
</div>
