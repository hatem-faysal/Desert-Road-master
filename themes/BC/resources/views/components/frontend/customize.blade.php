<div class="bravo-contact-block">
    <div class="container">
        <div class="row section">
            <div class="col-md-12 col-lg-5">
                <div  class="form_wrapper">
                    <form method="post" action="{{ route('customize.store') }}" class="bravo-contact-block">
                    @csrf
                    @method('post')
                        <div class="contact-form">
                            <div class="contact-header">
                                <h1>Customize with Desertroad</h1>
                                <h2>Send us a message and we'll respond as soon as possible</h2>
                            </div>
                            <div class="contact-form">
                                <div class="form-group">
                                    <label>Name</label>
                                        <input type="text" value="{{old('name')}}" placeholder=" Please Name " name="name" class="form-control" required>
                                        @if($errors->has('name')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('name')}}</div>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                        <input type="number" value="{{old('phone')}}" placeholder=" Please Phone " name="phone" class="form-control" required>
                                        @if($errors->has('phone')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('phone')}}</div>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" value="{{ old('email') }}" placeholder="Please Email" name="email" class="form-control" required>
                                        @if($errors->has('email')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('email')}}</div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label>City</label>
                                        <select  class="form-control" name="city_id" required>
                                            <option value="">{{__('-- Please select City --')}}</option>
                                            @foreach ($cities as $city)
                                            <option value="{{$city->id}}" @if (old('city_id')==$city->id) {{ 'selected' }} @endif >{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('city_id')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('city_id')}}</div>
                                        @endif
                                </div>
                                <div class="form-group">
                                <label>Number of people</label>
                                        <select  class="form-control" name="number_of_people" required>
                                        <option value="">{{__('-- Please select Number of people --')}}</option>
                                        @foreach ($NumberOfPeople as $item)
                                        <option value="{{$item}}" @if (old('number_of_people')==$item) {{ 'selected' }} @endif >{{$item}}</option>
                                        @endforeach
                                    </select>
                                        @if($errors->has('number_of_people')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('number_of_people')}}</div>
                                        @endif
                                </div>
                                <div class="form-group">
                                <label>Date From</label>
                                    <input type="date" value="{{old('date_from')}}" placeholder=" Date From " name="date_from" class="form-control" required>
                                        @if($errors->has('date_from')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('date_from')}}</div>
                                        @endif
                                </div>
                                <div class="form-group">
                                <label>Date To</label>
                                    <input type="date" value="{{old('date_to')}}" placeholder=" Date To " name="date_to" class="form-control" required>
                                        @if($errors->has('date_to')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('date_to')}}</div>
                                        @endif
                                </div>

                                <input type="hidden" name="url" value="{{ url()->full() }}" >

                                <div class="form-group">
                                    <textarea name="message" cols="40" rows="10" class="form-control textarea" required
                                        placeholder="Message">{!! old('message') !!}</textarea>
                                        @if($errors->has('message')) 
                                             <div class="p-3 mb-2 bg-danger text-white">{{$errors->first('message')}}</div>
                                        @endif
                                </div>
                                <p>
                                    <button class="submit btn btn-primary " type="submit">
                                        SEND MESSAGE
                                    </button>
                                </p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="offset-lg-2 col-md-12 col-lg-5">
                <div class="contact-info">
                    <div class="info-bg">
                        <img src="{{asset('uploads/custome.jpg')}}" class="img-responsive"
                            alt="We'd love to hear from you">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>