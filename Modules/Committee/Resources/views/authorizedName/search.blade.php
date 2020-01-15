    <form class="" method="get" id="search-committees" action="{{ route('committee.authorizedName') }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="advisor_id"> صفة الدخول</label>
                    {{-- {!! Form::select('job', $types, null, ['id' => 'job', 'class' => 'form_control select2', 'required' => true, 'value' => "{{ Request::input('entry_time') }}"]) !!} --}}
                    <select name="job" id="job" class="form_control select2">
                        <option value="0">{{ __('committee::committees.all') }}</option>
                        @foreach($types as $key => $type)
                            <option value="{{ $type }}" {{ Request::input('job') == $key ? 'selected':'' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="entry_time" class="control-label">تاريخ الدخول</label>
                    <input type="text" class="form_control date-picker"  name="entry_time" value="{{ Request::input('entry_time') }}" id="entry_time"
                           placeholder="" autocomplete="off">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="status" class="control-label">اجتماع المستشار</label>
                    <select name="advisor_id" id="advisor_id" class="form_control select2">
                        <option value="0">{{ __('committee::committees.all') }}</option>
                        @foreach($advisors as $key => $name)
                            <option value="{{ $key }}" {{ Request::input('advisor_id') == $key ? 'selected':'' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="national_id" class="control-label">رقم الهوية</label>
                    <input type="number" class="form_control" value="" name="national_id" id=""
                           placeholder="" autocomplete="off">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name" class="control-label"> الاسم</label>
                    <input type="text" class="form_control " value="" name="name" id="name"
                           placeholder="" autocomplete="off">
                </div>
            </div>

        </div>


        <div class="row">
        <a style="float: left;margin: 0px 5px 0 15px;" href="{{ route('committee.authorizedName') }}" class="btn btn-primary search-table">إلغاء</a>
            <button style="float: left;margin: 0px 5px;" type="submit" class="btn btn-primary search-table">بحث</button>
        </div>
       
    </form>
