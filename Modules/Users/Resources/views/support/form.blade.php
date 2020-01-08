
<div class="row">

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('support_type') ? ' has-error' : '' }}">

            <label for="support_type" class="control-label">
                {{ __('users::support.support_type') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('support_type', [], null, ['id' => 'support_type', 'class' => 'form_control select2', 'required' => true]) !!}

            @if ($errors->has('support_type'))
                <span class="help-block" ><strong>{{ $errors->first('support_type') }}</strong></span>
            @endif

        </div>
    </div>

</div>



<br />


<div class="row">

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('support_details') ? ' has-error' : '' }}">

            <label for="support_details" class="control-label">
                {{ __('users::support.support_details') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::textarea('support_details', null, ['id' => 'support_details', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('support_details'))
                <span class="help-block" ><strong>{{ $errors->first('support_details') }}</strong></span>
            @endif

        </div>
    </div>

</div>


<br />

<p class="underLine">{{ __('users::support.support_attachments') }}</p>


<div class="row">
    <div class="col-md-5">
        <div class="col-md-4">
            {!! Form::label('tasks',  __('users::support.file description'), ['class' => 'control-label']) !!}
        </div>

        <div class="col-md-8">
            {!! Form::text('file_description', null, ['id' => 'file_description', 'class' => 'form_control']) !!}
        </div>
    </div>

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
        <button type="button" data-order="1" class="btn btn-primary" id="saveFiles" data-url="{{ route('support.upload-attachments') }}">إضافة</button>
    </div>
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
                
            </tbody>
        </table>
    </div>
</div>