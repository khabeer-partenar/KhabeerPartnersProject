    <form class="" method="get" id="search-committees" action="{{ route(app()->request->route()->getName()) }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="advisor_id">المستشار المسؤول</label>

                    <select name="advisor_id" id="advisor_id" class="form_control select2">
                        <option value="0">{{ __('committee::committees.all') }}</option>
                        @foreach($advisors as $key => $name)
                            <option value="{{ $key }}" {{ Request::input('advisor_id') == $key ? 'selected':'' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="status" class="control-label">حالة اللجنة</label>
                    <select name="status" id="status" class="form_control select2">
                        <option value="0">{{ __('committee::committees.choose a status') }}</option>
                        @foreach(\Modules\Committee\Entities\Committee::STATUS as $key => $name)
                            <option value="{{ $key }}" {{ Request::input('status') == $key ? 'selected':'' }}>{{ __('committee::committees.' . $name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="created_at" class="control-label">تاريخ الطلب</label>
                    <input type="text" class="form_control date-picker" value="{{ Request::input('created_at') }}" name="created_at" id="treatment_time"
                           placeholder="" autocomplete="off">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="treatment_number" class="control-label">رقم المعاملة</label>
                    <input type="number" class="form_control" value="{{ Request::input('treatment_number') }}" name="treatment_number" id="treatment_number"
                           placeholder="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="treatment_time" class="control-label">تاريخ المعاملة</label>
                    <input type="text" class="form_control date-picker" value="{{ Request::input('treatment_time') }}" name="treatment_time" id="treatment_time"
                           placeholder="" autocomplete="off">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="uuid" class="control-label">رقم الطلب</label>
                    <input type="text" class="form_control" value="{{ Request::input('uuid') }}" name="uuid" id="uuid"
                        placeholder="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="subject" class="control-label">موضوع اللجنة</label>
                    <input type="text" class="form_control" value="{{ Request::input('subject') }}" name="subject" id="subject"
                           placeholder="" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="row">
            <a style="float: left;margin: 0px 5px 0 15px;" href="{{ route('committees.index') }}" class="btn btn-primary search-table">إلغاء</a>
            <button style="float: left;margin: 0px 5px;" type="submit" class="btn btn-primary search-table">بحث</button>
        </div>
    </form>
