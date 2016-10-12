@extends('backend.master')
@section('title', 'Booking')
@section('username', session('bk_name'))
<style>
    .sticky-header .main-content{
        padding: 0!important;
    }
</style>
@section('content')
    <style>
        .log_content {
            font-size: 13px;
            width: 100%;
            margin: 0;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .log_time {
            float: right;
            font-size: 12px;
        }

        .log {
            margin-bottom: 35px;
        }
        td:first-child{
            padding-left: 0!important;
            font-weight: bolder;
        }
    </style>
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="form-group" style="z-index: 1000">
                            <div class="col-lg-offset-2 col-lg-10" style="padding: 0">
                                <a onclick="history.back(-1);" class="btn btn-primary">Back</a>
                            </div>
                            <table class="table" style="margin-top: 11px">
                                <tbody>
                                <tr>
                                    <td>Booking code</td>
                                    <td>{{$booking->booking_code}}</td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td>{{$booking->mobile_user_id}}</td>
                                </tr>
                                <tr>
                                    <td>Place</td>
                                    <td>{{$booking->restaurant_name}}</td>
                                </tr>
                                <tr>
                                    <td>Booking type</td>
                                    <td>{{$booking->booking_type?'Priority':'Chope'}}</td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td>{{date('Y-m-d H:i',$booking->time)}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <select style="border: none" class="form-control" name="status" id="status" onchange="changeStatus()" disabled>
                                            <option value="0">Pending</option>
                                            <option value="1">Confirmed</option>
                                            <option value="2">Cancel</option>
                                            <option value="3">User Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Adults:{{$booking->adult}}</td>
                                    <td>Children:{{$booking->children}}</td>
                                </tr>
                                <tr>
                                    <td>Log</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group" id="log">
                            @foreach($booking_log as $item)
                                <div class="log">
                                    <p class="log_content">{{$item->content}}</p>
                                    <span class="log_time">{{date('Y-m-d H:i', strtotime($item->created_at))}}</span>
                                </div>
                            @endforeach
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<div>--}}
                                {{--<textarea class="form-control" id="content"></textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group" style="margin: 0">--}}
                            {{--<div class="col-lg-offset-2 col-lg-10 text-right">--}}
                                {{--<a id="add" onclick="createLog();">Add--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group text-center">
                            <button id="confirm_order" style="display: inline-block;width: 48%;" class="btn btn-default btn-block">
                                <a href="{{URL::action('BookingController@createNotification',['id'=>$booking->mobile_user_id,'status'=>'confirm'])}}">
                                    Confirm
                                </a>

                            </button>
                            <button id="cancel_order" style="display: inline-block;width: 48%;margin-top: 0" class="btn btn-default btn-block">
                                <a href="{{URL::action('BookingController@createNotification',['id'=>$booking->mobile_user_id,'status'=>'cancel'])}}">
                                    Cancel
                                </a>

                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#status').val('{{$booking->status}}');

            if($('#status').val == 2){
                $('#status').attr('disabled',true);
            }
            if('{{$booking->status}}' != 0){
                $("#status option[value='0']").remove();
            }
        });

        window.editBookingLog = '{{URL::route('admin.booking.create.log.do')}}';
        window.editBookingStatus = '{{URL::route('admin.booking.edit.status')}}';
        var date = new Date();
        year = date.getFullYear();
        month = formatDate(date.getMonth() + 1);
        day = formatDate(date.getDate());
        hour = formatDate(date.getHours());
        minute = formatDate(date.getMinutes());
//        second = formatDate(date.getSeconds());

        date = year + '-' + month + '-' + day + ' ' + hour + ':' + minute;
        function createLog() {
            $.ajax({
                type: 'POST',
                url: window.editBookingLog,
                data: {
                    booking_code: '{{$booking->booking_code}}',
                    user_id: '{{$booking->mobile_user_id}}',
                    content: $('#content').val()
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.result == 1) {
                        var content = $('#content').val().trim();
                        var myhtml = '<div class="log"><p class="log_content">' + content + '</p>' +
                                '<span class= "log_time" >' + date + '</span></div>';
                        $('#content').val('');
                        $('#log').append(myhtml);
                    }

                }
            });
        }
        function formatDate(date) {
            return date < 10 ? '0' + date : date;
        }


        function changeStatus(){
            console.log($('#status').val());
            var status = $('#status').val();
            $.ajax({
                type: 'POST',
                url: window.editBookingStatus,
                data: {
                    status: $('#status').val(),
                    booking_code:'{{$booking->booking_code}}'
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                }
            });
            $("#status option[value='0']").remove();
        }
    </script>
@endsection
