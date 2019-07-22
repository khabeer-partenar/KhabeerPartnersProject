<div class="row">
    <form class="" method="get" id="search-committees" action="{{ route('committees.index') }}">
        <div class="row">
            {{--form-inline--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="advisor_id">معاملات المستشار</label>
                    <div class="col-md-10">
                        <select name="advisor_id" id="advisor_id" class="form-control select2">
                            <option value="0">{{ __('committee::committees.all') }}</option>
                            @foreach($advisors as $key => $name)
                                <option value="{{ $key }}" {{ Request::input('advisors') == $key ? 'selected':'' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="col-md-2 control-label">اسم الجهة</label>
                    <div class="col-md-10">
                        <select name="status" id="status" class="form-control select2">
                            <option value="0">{{ __('committee::committees.choose a status') }}</option>
                            @foreach($status as $key => $name)
                                <option value="{{ $key }}" {{ Request::input('status') == $key ? 'selected':'' }}>{{ __('committee::committees.' . $name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="treatment_number" class="col-md-3  col-md-3-d control-label">رقم المعاملة</label>
                    <div class="col-md-9 col-md-9-d">
                        <input type="text" class="form-control" value="{{ Request::input('treatment_number') }}" name="treatment_number" id="treatment_number"
                               placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="treatment_time" class="col-md-3 control-label">تاريخ المعاملة</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control date-picker" value="{{ Request::input('treatment_time') }}" name="treatment_time" id="treatment_time"
                               placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="uuid" class="col-md-3 control-label">رقم الطلب</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="{{ Request::input('uuid') }}" name="uuid" id="uuid"
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
                        <input type="text" class="form-control" value="{{ Request::input('subject') }}" name="subject" id="subject"
                               placeholder="" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <button style="float: left;margin: 0px 15px;" type="submit" class="btn btn-default search-table">بحث</button>
    </form>
</div>