@extends('backend.master')
@section('title', 'Booking')
@section('username', session('bk_name'))
@section('heading')
    <div class="header-section" style="z-index: 9999">
        <a class="toggle-btn"><i class="fa fa-bars"></i></a>
        <div class="page-heading">
            <h3>
                Booking
            </h3>
        </div>
        <div>
            <a href="#" class="btn btn-primary"
               style="position: absolute;top: 50%;transform: translate(-50%,-50%);right: -31px;">Email Setting
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-xs-12">
                <section class="panel">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">状态：</label>
                        <select title="label" class="form-control" id="states">
                            <option value="0">Pending</option>
                            <option value="100">All</option>
                        </select>
                    </div>
                    <table class="table table-hover">
                        <tbody>

                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            window.queryUrl = '{{URL::route('admin.booking.query.do')}}';
            window.detailUrl = '{{URL::route('admin.booking.detail',1)}}';
            window.detailUrl = window.detailUrl.substring(0, window.detailUrl.length - 1);
            query();
            $('#states').change(function () {
//                alert($('#states').val());
                query();
            })

        })
        function query(){
            $.ajax({
                type: 'GET',
                url: window.queryUrl,
                data: {
                    states:$('#states').val()
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.result == 1) {
                        $('tbody').empty();
                        var jsondata = eval(data.booking);
                        $.each(jsondata, function (i, item) {
                            myhtml = '<tr>'
                                    + '<td>'
                                    + '<a href="' + window.detailUrl + item.booking_code + '">' +
                                    'Code:' + item.booking_code + ' ' + item.restaurant_name
                                    + '<br><span class="booking_style" style="font-size: 10px;">' +
                                    'User '+ item.mobile_user_id + ',Adult:' + item.adult +',Children:'+ item.children
                                    + '</span>'
                                    + '</a></td></tr>';
                            $('tbody').append(myhtml);
                        })
                    }
                }
            });
        }
    </script>
@endsection
