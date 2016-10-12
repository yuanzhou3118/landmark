@extends('backend.master')
@section('title', 'Restaurant')
@section('css')
    <link href="{{URL::asset('assets/backend/css/file-upload.css')}}" rel="stylesheet">
@endsection
@section('username', session('bk_name'))
<style>
    .sticky-header .main-content {
        padding: 0 !important;
    }
</style>
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="form-group" style="position: absolute;z-index: 1000">
                            <div class="col-lg-offset-2 col-lg-10" style="padding: 0">
                                <a href="{{URL::route('admin.restaurant.query')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" action="{{URL::route('admin.restaurant.create.do')}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10 text-right">
                                    <button type="submit" id="add" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissable" id="result">
                                <a type="button" class="close" data-dismiss="alert"
                                   aria-hidden="true">
                                    &times;
                                </a>
                                <span>{{$result or ''}}</span>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{$restaurant->name}}">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Image</label>
                                <div class="container">
                                    <ul id="file" class="fl"></ul>
                                    <div class="upload-btn fl">
                                        <span>+</span>
                                        <input type="file" name="upload" id="fu">
                                    </div>
                                </div>
                                <div class="uploadShow">
                                    <p>Uploading...</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Open Hours</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="open_hours" id="open_hours"
                                           value="{{$restaurant->open_hours}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Booking Hours</label>
                                <div id="edit-booking-hour" class="btn btn-default">Edit</div>
                                <div class="col-lg-10"><span class="bookingHours"></span></div>
                                <div class="col-lg-10" id="booking_hours" style="display: none">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Title</label>
                                <select class="col-lg-2 col-sm-2 m-bot15" style="border: 0" name="title-lang"
                                        id="title-lang">
                                    <option value="en">EN</option>
                                    <option value="sc">SC</option>
                                    <option value="tc">TC</option>
                                </select>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control title" id="en-title" name="en_title" value="{{$restaurant->en_title}}" maxlength="50">
                                    <input type="text" class="form-control title" id="sc-title" name="sc_title" value="{{$restaurant->sc_title}}" maxlength="50" style="display: none">
                                    <input type="text" class="form-control title" id="tc-title" name="tc_title" value="{{$restaurant->tc_title}}" maxlength="50" style="display: none">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Description</label>
                                <select class="col-lg-2 col-sm-2 m-bot15" style="border: 0" name="description-lang" id="description-lang">
                                    <option value="en">EN</option>
                                    <option value="sc">SC</option>
                                    <option value="tc">TC</option>
                                </select>
                                <div class="col-lg-10">
                                    <textarea class="form-control description" id="en-description" name="en_description">
                                        {{$restaurant->en_description}}
                                    </textarea>
                                    <textarea class="form-control description" id="sc-description" name="sc_description" style="display: none">
                                        {{$restaurant->sc_description}}
                                    </textarea>
                                    <textarea class="form-control description" id="tc-description" name="tc_description" style="display: none">
                                        {{$restaurant->tc_description}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Logo Url</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="logo_url" id="logo_url"
                                           value="{{$restaurant->logo_url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Contact Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="contact_name" id="contact_name"
                                           value="{{$restaurant->contact_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Contact
                                    Phone</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                                           value="{{$restaurant->contact_phone}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Location</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="location" id="location">
                                        <option>HK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Booking type</label>
                                <div class="col-lg-10">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="booking_style" value="0" name="booking_style[]">Chope
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="booking_style" value="1" name="booking_style[]">Priority
                                        Booking
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Status</label>
                                <div class="col-lg-10">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="active" name="active">Active
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">Restaurant
                                    URL</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="url" id="url"
                                           value="{{$restaurant->restaurant_url}}">
                                    <input type="hidden" class="form-control" name="image_url" id="image_url"
                                           value="{{$restaurant->image_url}}">
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{{URL::asset('assets/backend/js/app.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('button[type="submit"]').click(function () {
                var img_url = [];
                $.each($('#file li img'), function (index, item) {
                    img_url.push(item.getAttribute('src'));
                });
                img_url = img_url.join(';');
                console.log(img_url);
                $('#image_url').val(img_url);

                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: '{{URL::route('admin.restaurant.create.do')}}',--}}
                    {{--data: {--}}
                        {{--image_url: img_url--}}
                    {{--},--}}
                    {{--dataType: 'json'--}}
                {{--});--}}
            });

            $('#edit-booking-hour').click(function () {
                if ($('#booking_hours').css('display') == 'block') {
                    $('#booking_hours').hide();
                    $('#edit-booking-hour').text('Edit');
                    var booking_hours = [];
                    $('#booking_hours input:checked').each(function () {
                        booking_hours.push($(this).parent().text());
                    })
                    booking_hours = booking_hours.join();
                    $('.bookingHours').text(booking_hours);
                }
                else {
                    $('#booking_hours').show();
                    @if (count(json_decode($restaurant->booking_hours)))
                        @foreach(json_decode($restaurant->booking_hours) as $item)
                            $('#booking_hours input[value="{{$item}}"]').attr("checked", 'true');
                    @endforeach
                    @endif
                    $('#edit-booking-hour').text('Confirm');
                }
            });
            $('#title-lang').click(function () {
                if ($('#title-lang').val() == 'en') {
                    $('.title').hide();
                    $('#en-title').show();
                }
                if ($('#title-lang').val() == 'sc') {
                    $('.title').hide();
                    $('#sc-title').show();
                }
                if ($('#title-lang').val() == 'tc') {
                    $('.title').hide();
                    $('#tc-title').show();
                }
            });

            $('#description-lang').click(function () {
                if($('#description-lang').val() == 'en'){
                    $('.description').hide();
                    $('#en-description').show();
                }
                if($('#description-lang').val() == 'sc'){
                    $('.description').hide();
                    $('#sc-description').show();
                }
                if($('#description-lang').val() == 'tc'){
                    $('.description').hide();
                    $('#tc-description').show();
                }
            })

            var booking_style = '{{$restaurant->booking_type}}';
            if (booking_style == 2) {
                $('input:checkbox').eq(0).attr("checked", 'true');
                $('input:checkbox').eq(1).attr("checked", 'true');
            } else {
                $('input:checkbox').eq(booking_style).attr("checked", 'true');
            }

            if ($('#result span').text().length == 0) {
                $('#result').hide();
            }

            var myhtml = null;

            for (var k = 6; k < 22; k++) {
                if (k < 13) {
                    myhtml = '<label class="checkbox-inline">'
                            + '<input type="checkbox" id="booking_hours" value="' + k + '" name="booking_hours[]">'
                            + k + 'AM'
                            + '</label>';

                    document.getElementById("booking_hours").innerHTML += myhtml;
                } else {
                    myhtml = '<label class="checkbox-inline">'
                            + '<input type="checkbox" id="booking_hours" value="' + k + '" name="booking_hours[]">'
                            + (k - 12) + 'PM'
                            + '</label>';
                    document.getElementById("booking_hours").innerHTML += myhtml;
                }
            }

            if ('{{$restaurant->active}}' == 1) {
                $('#active').attr('checked', 'true')
            }
            $('footer').removeClass('sticky-footer');

        });


    </script>
@endsection
