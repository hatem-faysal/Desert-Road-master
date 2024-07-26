@extends('admin.layouts.app')

@section('content')
    <form action="{{route('multiroom.admin.update',['id'=>($row->id??'') ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id??'' ? __('Edit Multi Location: ').$row->title??'' : __('Add  Multi Room')}}</h1>
                    @if($row->slug??'')
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url(config('tour.tour_route_prefix') ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @if($row->id??'')
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        @include('Tour::admin/multiroom/tour-multiroom')
                        @include('Tour::admin/multiroom/index-multiroom')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}

@endpush
