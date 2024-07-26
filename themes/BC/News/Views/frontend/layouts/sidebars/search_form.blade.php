<div class="sidebar-widget widget_search">
        @php
        if(Request::segment(1)=='blogs'){
            $config =  config('news.blogs_route_prefix');
        }else{
            $config = config('news.news_route_prefix');
        }
        @endphp
    <form method="get" class="search" action="{{ url(app_get_locale(false,false,'/').$config) }}">
        <input type="text" class="form-control" value="{{ Request::query("s") }}" name="s" placeholder="{{__("Search ...")}}">
        <button type="submit" class="icon_search"></button>
    </form>
</div>