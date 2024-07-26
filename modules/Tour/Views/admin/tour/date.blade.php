<div class="panel">
    <div class="panel-title"><strong>{{__("Dates")}}</strong></div>
    <div class="panel-body">
        <h3 class="panel-body-title">{{__('Start Date')}}</h3>
        <div class="form-group">
            <label>
                <input type="datetime-local" class="form-control" name="start_date" value="{{$row->start_date}}">
            </label>
        </div>
        <h3 class="panel-body-title">{{__('End Date')}}</h3>
        <div class="form-group">
            <label>
                <input type="datetime-local" class="form-control" name="end_date" value="{{$row->end_date}}">
            </label>
        </div>
    </div>
</div>