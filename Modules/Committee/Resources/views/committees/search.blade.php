<div class="row">
    <form class="" method="get" id="search-committees" action="{{ route('committees.index') }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="advisor_id">المستشار المسؤول</label>
                    <div class="col-md-9">
                        <select name="advisor_id" id="advisor_id" class="form_control select2">
                            <option value="0">{{ __('committee::committees.all') }}</option>
                            @foreach($advisors as $key => $name)
                                <option value="{{ $key }}" {{ Request::input('advisor_id') == $key ? 'selected':'' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="status" class="col-md-3 control-label">حالة اللجنة</label>
                    <div class="col-md-9">
                        <select name="status" id="status" class="form_control select2">
                            <option value="0">{{ __('committee::committees.choose a status') }}</option>
                            @foreach($status as $key => $name)
                                <option value="{{ $key }}" {{ Request::input('status') == $key ? 'selected':'' }}>{{ __('committee::committees.' . $name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="created_at" class="col-md-3 control-label">تاريخ الطلب</label>
                    <div class="col-md-9">
                        <input type="text" class="form_control date-picker" value="{{ Request::input('created_at') }}" name="created_at" id="treatment_time"
                               placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="treatment_number" class="col-md-3  col-md-3-d control-label">رقم المعاملة</label>
                    <div class="col-md-9 col-md-9-d">
                        <input type="number" class="form_control" value="{{ Request::input('treatment_number') }}" name="treatment_number" id="treatment_number"
                               placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="treatment_time" class="col-md-3 control-label">تاريخ المعاملة</label>
                    <div class="col-md-9">
                        <input type="text" class="form_control date-picker" value="{{ Request::input('treatment_time') }}" name="treatment_time" id="treatment_time"
                               placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="uuid" class="col-md-3 control-label">رقم الطلب</label>
                    <div class="col-md-9">
                        <input type="text" class="form_control" value="{{ Request::input('uuid') }}" name="uuid" id="uuid"
                               placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="subject" class="col-md-1 control-label">موضوع اللجنة</label>
                    <div class="col-md-11">
                        <input type="text" class="form_control" value="{{ Request::input('subject') }}" name="subject" id="subject"
                               placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <a style="float: left;margin: 0px 5px 0 15px;" href="{{ route('committees.index') }}" class="btn btn-default search-table">إلغاء</a>
        <button style="float: left;margin: 0px 5px;" type="submit" class="btn btn-default search-table">بحث</button>
    </form>
</div>