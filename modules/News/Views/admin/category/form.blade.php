<div class="form-group">
    <label> {{ __('Name')}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="Category name" name="name" class="form-control">
</div>
@if(is_default_lang())
<div class="form-group">
    <label> {{ __('Parent')}}</label>
    <select name="parent_id" class="form-control">
        <option value=""> {{ __('-- Please Select --')}}</option>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
            foreach ($categories as $category) {
                if ($category->id == $row->id) {
                    continue;
                }
                $selected = '';
                if ($row->parent_id == $category->id)
                    $selected = 'selected';
                printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($parents);
        ?>
    </select>
</div>
{{-- ----------Type------- --}}
<div class="form-group">
    <label>{{  __('Type')}} </label>
    <select name="type" class="form-control">
        {{-- <option selected="" value=null disabled>{{ __('-- Please Select --')}}</option> --}}
        @php
            $data_model = ['news','blogs'];
        @endphp
        @foreach ($data_model as $item)
        @if (isset($row->id))
        {{--  edit  --}}
        <option value="{{$item}}" {{ $item == $row->type ?'selected':''}}>{{$item}}</option>
        @else
        {{--  create  --}}
        <option value="{{$item}}" @if (old('type')==$item) {{ 'selected' }} @endif >{{$item}}</option>
        @endif
        @endforeach
    </select>
</div>
{{-- -----------Type------ --}}
<div class="form-group">
    <label> {{ __('Slug')}}</label>
    <input type="text" value="{{$row->slug}}" placeholder="Category slug" name="slug" class="form-control">
</div>
@endif
{{--<div class="form-group">--}}
    {{--<label class="control-label"> {{ __('Description')}}</label>--}}
    {{--<textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>--}}
{{--</div>--}}