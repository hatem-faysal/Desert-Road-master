<div class="bravo_filter">
    <form action="{{url(app_get_locale(false,false,'/').config('tour.tour_route_prefix'))}}" class="bravo_form_filter">
        @if( !empty(Request::query('location_id')) )
            <input type="hidden" name="location_id" value="{{Request::query('location_id')}}">
        @endif
            @if( !empty(Request::query('map_place')) )
            <input type="hidden" name="map_place" value="{{Request::query('map_place')}}">
        @endif
            @if( !empty(Request::query('map_lat')) )
            <input type="hidden" name="map_lat" value="{{Request::query('map_lat')}}">
        @endif
            @if( !empty(Request::query('map_lgn')) )
            <input type="hidden" name="map_lgn" value="{{Request::query('map_lgn')}}">
        @endif
        @if( !empty(Request::query('start')) and !empty(Request::query('end')) )
            <input type="hidden" value="{{Request::query('start',date("d/m/Y",strtotime("today")))}}" name="start">
            <input type="hidden" value="{{Request::query('end',date("d/m/Y",strtotime("+1 day")))}}" name="end">
            <input type="hidden" name="date" value="{{Request::query('date')}}">
        @endif
        <div class="filter-title">
            {{__("FILTER BY")}}
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h3>{{__("Filter Price")}}</h3>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
            <div class="item-content">
                <div class="bravo-filter-price">
                    <?php
                    $price_min = $pri_from = floor ( App\Currency::convertPrice($tour_min_max_price[0]) );
                    $price_max = $pri_to = ceil ( App\Currency::convertPrice($tour_min_max_price[1]) );
                    if (!empty($price_range = Request::query('price_range'))) {
                        $pri_from = explode(";", $price_range)[0];
                        $pri_to = explode(";", $price_range)[1];
                    }
                    $currency = App\Currency::getCurrency( App\Currency::getCurrent() );
                    ?>
                    <input type="hidden" class="filter-price irs-hidden-input" name="price_range"
                           data-symbol=" {{$currency['symbol'] ?? ''}}"
                           data-min="{{$price_min}}"
                           data-max="{{$price_max}}"
                           data-from="{{$pri_from}}"
                           data-to="{{$pri_to}}"
                           readonly="" value="{{$price_range}}">
                    <button type="submit" class="btn btn-link btn-apply-price-range">{{__("APPLY")}}</button>
                </div>
            </div>
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h3>{{__("Review Score")}}</h3>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
            <div class="item-content">
                <ul>
                    @for ($number = 5 ;$number >= 1 ; $number--)
                        <li>
                            <div class="bravo-checkbox">
                                <label>
                                    <input name="review_score[]" type="checkbox" value="{{$number}}" @if(  in_array($number , request()->query('review_score',[])) )  checked @endif>
                                    <span class="checkmark"></span>
                                    @for ($review_score = 1 ;$review_score <= $number ; $review_score++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </label>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h3>{{__("Package Type")}}</h3>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
            <div class="item-content">
                <ul>
                    <?php
                    $current_category_ids = Request::query('cat_id');
                    $traverse = function ($categories, $prefix = '') use (&$traverse, $current_category_ids) {
                    $i = 0;
                    foreach ($categories as $category) {
                        $checked = '';
                        if (!empty($current_category_ids)) {
                            foreach ($current_category_ids as $key => $current) {
                                if ($current == $category->id)
                                    $checked = 'checked';
                            }
                        }
                        $traslate = $category->translate()
                        ?>
                        <li @if($i > 2 and empty($current_category_ids)) class="hide" @endif>
                            <div class="bravo-checkbox">
                                <label>
                                    <input name="cat_id[]" {{$checked}} type="checkbox" value="{{$category->id}}"> {{$prefix}} {{$traslate->name}}
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </li>
                        <?php
                        $i++;
                        $traverse($category->children, $prefix . '-');
                        }
                    };
                    $traverse($tour_category);
                    ?>
                </ul>
                @if(count($tour_category) > 3 and empty($current_category_ids))
                    <button type="button" class="btn btn-link btn-more-item">{{__("More")}} <i class="fa fa-caret-down"></i></button>
                @endif
            </div>
        </div>
        @php
            $selected = (array) Request::query('terms');
        @endphp
        @foreach ($attributes as $item)
            @if(empty($item['hide_in_filter_search']))
                @php
                    $translate = $item->translate();
                @endphp
                <div class="g-filter-item">
                    <div class="item-title">
                        <h3> {{$translate->name}} </h3>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </div>
                    <div class="item-content">
                        <ul>
                            @foreach($item->terms as $key => $term)
                                @php $translate = $term->translate(); @endphp
                                <li @if($key > 2 and empty($selected)) class="hide" @endif>
                                    <div class="bravo-checkbox">
                                        <label>
                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"> {!! $translate->name !!}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if(count($item->terms) > 3 and empty($selected))
                            <button type="button" class="btn btn-link btn-more-item">{{__("More")}} <i class="fa fa-caret-down"></i></button>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </form>
</div>


