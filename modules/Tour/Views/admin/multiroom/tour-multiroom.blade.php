<div class="panel">
    <div class="panel-title"><strong>{{__("Multi Room Package")}}</strong></div>
    <div class="panel-body">
    
        <input type="hidden"  name="tour_id" value="{{ $id }}">
        <div class="form-group">
            <label class="control-label">{{__("Name")}}</label>
            <input type="text" required name="name" id="name" class="form-control" placeholder="{{__("name")}}" value="{{$translation->name??''}}">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Price")}}</label>
            <input type="text" required name="price" id="price" class="form-control" placeholder="{{__("price")}}" value="{{$translation->price??''}}">
        </div>
    </div>
</div>
