<div class="bravo_single_book_wrap @if(setting_item('tour_enable_inbox')) has-vendor-box @endif">
    <div class="bravo_single_book">
        <div id="bravo_tour_book_app" v-cloak>
            @if($row->discount_percent)
            <div class="tour-sale-box">
                <span class="sale_class box_sale sale_small">{{$row->discount_percent}}</span>
            </div>
            @endif
            <div class="form-head">
                <div class="price">
                    <span class="label">
                        {{__("from")}}
                    </span>
                    <span class="value">
                        <span class="onsale">{{ $row->display_sale_price }}</span>
                        <span class="text-lg">{{ $row->display_price }}</span>
                    </span>
                </div>
            </div>
            <div class="nav-enquiry" v-if="is_form_enquiry_and_book">
                <div class="enquiry-item active">
                    <span>{{ __("Book") }}</span>
                </div>
                <div class="enquiry-item" data-toggle="modal" data-target="#enquiry_form_modal">
                    <span>{{ __("Enquiry") }}</span>
                </div>
            </div>
            <div class="form-book" :class="{'d-none':enquiry_type!='book'}">
                <div class="form-content">
                    <div class="form-group form-date-field form-date-search clearfix "
                        data-format="{{get_moment_date_format()}}">
                        <div class="d-flex p-2  flex-wrap clearfix text-center" v-if="is_fixed_date">
                            <div class="w-50 py-3 flex-grow-1">
                                <div class="font-weight-bold">{{__("Tour Start Date")}}</div>
                                <span>@{{ start_date_html }}</span>
                            </div>
                            <div class="w-50 py-3 flex-grow-1 border-left">
                                <div class="font-weight-bold">{{__("Tour End Date")}}</div>
                                <span>@{{ end_date_html }}</span>
                            </div>
                            <div class="w-100 py-3 flex-grow-1 border-top">
                                <div class="font-weight-bold">{{__("Last Booking Date")}}</div>
                                <span>@{{ last_booking_date_html }}</span>
                            </div>
                        </div>
                        <div class="date-wrapper clearfix" v-else>
                            <div class="check-in-wrapper">
                                <label>{{__("Date")}}</label>
                                <div class="render check-in-render">
                                    @if (isset($row->start_date))
                                    {{$row->start_date->format('m/d/Y')}} 
                                    @endif
                                    <i class="fa fa-long-arrow-right" style="font-size: inherit"></i>
                                    @if (isset($row->end_date))
                                    {{$row->end_date->format('m/d/Y') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (isset($row->start_date))
                        <input type="hidden" id="date_start_new" value="{{ $row->start_date->format('Y-m-d') }}">
                        @endif
                        @if (isset($row->end_date))
                        <input type="hidden" id="date_end_new" value="{{ $row->end_date->format('Y-m-d') }}">
                        @endif
                        <input type="hidden" id="priceNew" value="{{ $row->sale_price??0 }}">
                        @if (isset($row->start_date) && isset($row->end_date))
                        <input type="text" id="start_date" class="start_date"
                            value="{{ $row->start_date->format('Y-m-d').' - '.$row->end_date->format('Y-m-d') }}"
                            ref="start_date" style="height: 1rem; visibility:hidden ">
                        @endif
                    </div>
                    {{-- ----------Drop Down multe price------ --}}
                    <div class="form-group form-guest-search">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="travel_id" id="travel_id" value="{{ $row->id }}">
                                <label style="color: #1a2b48;" class="title_name">Multe Room </label> 
                                <select name="multe-room"  @change="MulteRoomChange($event)"  id="multe-room" class="multe-room form-control">
                                        <option selected="" value=null disabled>Select Multe Room ...</option> 
                                        <option  v-for="item in AllData" v-bind:value="item.price"  :key="item.id"> 
                                            @{{ item.name }}
                                        </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- ----------Drop Down multe price------ --}}

                    <div class="" v-if="person_types">
                        <div class="form-group form-guest-search">
                            <div class="guest-wrapper d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label>{{__("Guests")}}</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="input-number-group">
                                        <i class="icon ion-ios-remove-circle-outline" @click="minusGuestsType()"></i>
                                        <span class="input"><input type="number" v-model="guests" min="1" /></span>
                                        <i class="icon ion-ios-add-circle-outline" @click="addGuestsType()"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-section-group form-group" v-if="extra_price.length">
                        <h4 class="form-section-title">{{__('Extra prices:')}}</h4>
                        <div class="form-group" v-for="(type,index) in extra_price">
                            <div class="extra-price-wrap d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <label><input type="checkbox" true-value="1" false-value="0" v-model="type.enable">
                                        @{{type.name}}</label>
                                    <div class="render" v-if="type.price_type">(@{{type.price_type}})</div>
                                </div>
                                <div class="flex-shrink-0">@{{type.price_html}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-section-group form-group-padding" v-if="buyer_fees.length">
                        <div class="extra-price-wrap d-flex justify-content-between" v-for="(type,index) in buyer_fees">
                            <div class="flex-grow-1">
                                <label>@{{type.type_name}}
                                    <i class="icofont-info-circle" v-if="type.desc" data-toggle="tooltip"
                                        data-placement="top" :title="type.type_desc"></i>
                                </label>
                                <div class="render" v-if="type.price_type">(@{{type.price_type}})</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="unit" v-if='type.unit == "percent"'>
                                    @{{ type.price }}%
                                </div>
                                <div class="unit" v-else>
                                    @{{ formatMoney(type.price) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="form-section-total list-unstyled" v-if="total_price > 0">
                    <li>
                        <label>{{__("Total")}}</label>
                        <span class="price">@{{total_price_html}}</span>
                    </li>
                    <li v-if="is_deposit_ready">
                        <label for="">{{__("Pay now")}}</label>
                        <span class="price">@{{pay_now_price_html}}</span>
                    </li>
                </ul>
                <div v-html="html"></div>
                <div class="submit-group">
                    <a class="btn btn-large" @click="doSubmit($event)"
                        :class="{'disabled':onSubmit,'btn-success':(step == 2),'btn-primary':step == 1}" name="submit">
                        <span>{{__("BOOK NOW")}}</span>
                        <i v-show="onSubmit" class="fa fa-spinner fa-spin"></i>
                    </a>
                    <div class="alert-text mt10" v-show="message.content" v-html="message.content"
                        :class="{'danger':!message.type,'success':message.type}"></div>
                </div>
            </div>
            <div class="form-send-enquiry" v-show="enquiry_type=='enquiry'">
                <button class="btn btn-primary" data-toggle="modal" data-target="#enquiry_form_modal">
                    {{ __("Contact Now") }}
                </button>
            </div>
        </div>
    </div>
</div>
@include("Booking::frontend.global.enquiry-form",['service_type'=>'tour'])