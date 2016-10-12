<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//后台登陆
//登陆页面 #admin-login
Route::get('login', 'Admin\AdminController@login')->name('admin.login');
//提交登陆页面 #admin-login
Route::post('login', 'Admin\AdminController@doLogin')->name('admin.login.do');
//退出后台登陆 #admin-logout
Route::get('logout', 'Admin\AdminController@doLogout')->name('admin.logout');

Route::group(['middleware' => 'backend.auth'], function () {

    //帮助中心 #ac
    //数据回滚 #db-migrate-rollback
    Route::get('acdmr', 'Admin\HelpCenterController@migrateReset')->name('db.migrate.reset');
    //清空缓存 #cache-clear
    Route::get('accc', 'Admin\HelpCenterController@clearCache')->name('cache.clear');
    //数据迁移 #db-migrate
    Route::get('acdm', 'Admin\HelpCenterController@migrate')->name('db.migrate');
    //初始化数据 #db-seed
    Route::get('acds', 'Admin\HelpCenterController@seed')->name('db.seed');
    //系统设置页面 #admin-setting
    Route::get('acas', 'Admin\HelpCenterController@appSetting')->name('admin.setting');
    //执行优化操作 #admin-optimize
    Route::get('acao', 'Admin\HelpCenterController@optimize')->name('admin.optimize');
    //查看系统log
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('sys.log');

    //后台维护 #admin-dashboard
    Route::get('ad', 'Admin\AdminController@index')->name('admin.dashboard');
//    Route::get('backend-login', 'Admin\AdminController@PSAlogin')->name('admin.dashboard');

    //User Management
    Route::get('user', 'UserManagementController@query')->name('admin.user.query');
    Route::get('create-user', 'UserManagementController@create')->name('admin.user.create');//新建页面
    Route::post('create-user', 'UserManagementController@store')->name('admin.user.create.do');//保存页面
    Route::get('edit-user-{id}', 'UserManagementController@edit')->name('admin.user.edit');//编辑页面
    Route::post('edit-user-{id}', 'UserManagementController@update')->name('admin.user.edit.do');//更新页面
    Route::post('delete-user-{id}', 'UserManagementController@delete')->name('admin.user.delete');//删除页面

    //F&B
    Route::get('restaurant', 'FAndBController@query')->name('admin.restaurant.query');
    Route::get('create-restaurant', 'FAndBController@create')->name('admin.restaurant.create');//新建页面
    Route::post('create-restaurant', 'FAndBController@store')->name('admin.restaurant.create.do');//保存页面
    Route::get('edit-restaurant-{id}', 'FAndBController@edit')->name('admin.restaurant.edit');//编辑页面
    Route::post('edit-restaurant-{id}', 'FAndBController@update')->name('admin.restaurant.edit.do');//更新页面
    Route::post('delete-restaurant-{id}', 'FAndBController@delete')->name('admin.restaurant.delete');//删除页面
    Route::post('upload-images', 'FAndBController@uploadImage');//上传图片

    //Booking
    Route::get('booking', 'BookingController@manage')->name('admin.booking.query');
    Route::get('booking-query', 'BookingController@query')->name('admin.booking.query.do');
    Route::post('create-booking-log', 'BookingController@storeLog')->name('admin.booking.create.log.do');//保存页面
    Route::get('detail-booking-{bookingCode}', 'BookingController@detail')->name('admin.booking.detail');//编辑页面
    Route::post('edit-booking', 'BookingController@updateStatus')->name('admin.booking.edit.status');//更新页面
    Route::get('create-notification-{id}-{status}', 'BookingController@createNotification')->name('admin.booking.notification.create');//发送订单数据
//    Route::post('delete-booking-{id}', 'BookingController@delete')->name('admin.booking.delete');//删除页面

    //Calendar
    Route::get('calendar', 'CalendarController@daily')->name('admin.calendar.daily');//日历
    Route::get('appointment-calendar', 'CalendarController@dailyDo')->name('admin.calendar.daily.do');//日历

    //Appointment
    Route::get('appointment', 'AppointmentController@query')->name('admin.appointment.query');//appointment
    Route::get('create-appointment', 'AppointmentController@create')->name('admin.appointment.create');//新建页面
    Route::post('create-appointment', 'AppointmentController@store')->name('admin.appointment.create.do');//保存页面
    Route::get('edit-appointment-{id}', 'AppointmentController@edit')->name('admin.appointment.edit');//编辑页面
    Route::post('edit-appointment-{id}', 'AppointmentController@update')->name('admin.appointment.edit.do');//更新页面
    Route::post('delete-appointment-{id}', 'AppointmentController@delete')->name('admin.appointment.delete');//删除页面

    //Room
    Route::get('room-manage', 'RoomController@query')->name('admin.room.query');//room管理页面
    Route::get('create-room', 'RoomController@create')->name('admin.room.create');//新建页面
    Route::post('create-room', 'RoomController@store')->name('admin.room.create.do');//保存页面
    Route::get('edit-room-{id}', 'RoomController@edit')->name('admin.room.edit');//编辑页面
    Route::post('edit-room-{id}', 'RoomController@update')->name('admin.room.edit.do');//更新页面
    Route::post('delete-room-{id}', 'RoomController@delete')->name('admin.room.delete');//删除页面

    //WishList
    Route::get('wish-list', 'WishListController@query')->name('admin.wish.query');//room管理页面


    //Notification
    Route::get('send', 'NotificationController@send')->name('admin.send.notification');//发送页面
    Route::get('notification-manage', 'NotificationController@query')->name('admin.notification.query');//Notification管理页面
    Route::get('create-notification', 'NotificationController@create')->name('admin.notification.create');//新建页面
    Route::get('createDeviceGroup-{notification_group_name}', 'NotificationController@deviceGroup');//创建群组
    Route::post('create-notification', 'NotificationController@store')->name('admin.notification.create.do');//发送所有设备
    Route::get('edit-notification-{id}', 'NotificationController@edit')->name('admin.notification.edit');//编辑页面
    Route::post('edit-notification-{id}', 'NotificationController@update')->name('admin.notification.edit.do');//更新页面
    Route::post('delete-notification-{id}', 'NotificationController@delete')->name('admin.notification.delete');//删除页面

    Route::post('send-notification-{userId}', 'NotificationController@sendSingleDevice')->name('send.notification.single.device');//发送单一设备

    Route::get('remove-device-group', 'NotificationController@removeDeviceGroup');//移除分组



});

//用户模块
Route::get('/LM/MO/v1/User', 'Api\UserController@login')->name('api.v1.user.login');//登录接口
Route::post('/LM/MO/v1/User', 'Api\UserController@register')->name('api.v1.user.register');//注册接口
Route::post('/LM/MO/v1/User/{id}', 'Api\UserController@profile')->name('api.v1.user.profile');//获取用户详细信息接口
Route::put('/LM/MO/v1/User/{id}', 'Api\UserController@editProfile')->name('api.v1.user.profile.edit');//编辑用户详细信息接口
Route::post('/LM/MO/v1/User/{id}/Preference', 'Api\UserController@createPreference')->name('api.v1.create.user.preference');//Create User Preference
Route::put('/LM/MO/v1/User/{id}/Preference', 'Api\UserController@editPreference')->name('api.v1.edit.user.preference');//Edit User Preference
Route::post('/LM/MO/v1/User/{id}/Token', 'Api\UserController@token')->name('api.v1.user.token');//Set user notification token
Route::get('/LM/MO/v1/User/Bespoke/{mobile}', 'Api\UserController@byMobile')->name('api.v1.user.by.mobile');//Set user notification token

//产品模块
Route::get('/LM/MO/v1/Products', 'Api\ProductController@query')->name('api.v1.product.query');//获取产品清单接口
Route::get('/LM/MO/v1/Products/{id}', 'Api\ProductController@detail')->name('api.v1.product.detail');//获取产品详细信息
Route::get('/LM/MO/v1/Products/Recom/{id}', 'Api\ProductController@byUser')->name('api.v1.product.detail');//Recommend products by user
Route::post('/LM/MO/v1/Products/Recom', 'Api\ProductController@byProduct')->name('api.v1.product.detail');//Recommend products by products

//PS
Route::post('/LM/MO/v1/PS/{id}', 'Api\PSController@sendMsg')->name('api.v1.ps.send.msg');//获取产品详细信息
Route::get('/LM/MO/v1/PS/{id}', 'Api\PSController@queryMsg')->name('api.v1.ps.query.msg');//获取产品详细信息

//general
Route::post('/LM/MO/v1/Img', 'Api\GeneralController@uploadImg')->name('api.v1.upload.img');//上传图片
Route::get('/LM/MO/v1/Img/{id}', 'Api\GeneralController@getImgDetail')->name('api.v1.get.img.detail');//上传图片

//news
Route::get('/LM/MO/v1/News', 'Api\NewsController@query')->name('api.v1.news.query');//Retrieve news list
Route::get('/LM/MO/v1/News/{id}', 'Api\NewsController@detail')->name('api.v1.news.detail');//Retrieve news url


//wishlist
Route::post('/LM/MO/v1/Wish/{id}/{productId}', 'Api\WishListController@addProduct')->name('api.v1.wishlist.add.product');//添加产品
//Route::get('/LM/MO/v1/Wish/{id}/Products', 'Api\WishListController@addProduct')->name('api.v1.news.detail');//添加产品
Route::delete('/LM/MO/v1/Wish/{userid}/{productId}', 'Api\WishListController@delete')->name('api.v1.wishlist.product.delete');//删除接口
Route::get('/LM/MO/v1/Wish/{userid}', 'Api\WishListController@query')->name('api.v1.wishlist.query');//查看wishlist

//FNB
Route::get('/LM/MO/v1/Shop', 'Api\FNBController@query')->name('api.v1.fnb.query');//Retrieve shop info
Route::post('/LM/MO/v1/Shop/{userId}', 'Api\FNBController@priorityBooking')->name('api.v1.fnb.priority');//Priority Booking
Route::get('/LM/MO/v1/Shop/{userId}', 'Api\FNBController@getBookingList')->name('api.v1.fnb.get.list');//Booking List
Route::put('/LM/MO/v1/Shop/Booking/{bookingId}', 'Api\FNBController@updatePriority')->name('api.v1.fnb.update.priority');//Priority Booking update
Route::get('/LM/MO/v1/Shop/Booking/{bookingCode}', 'Api\FNBController@getStatus')->name('api.v1.fnb.get.status');//Booking Status


#Voucher
//Retrieve User Point
Route::get('/LM/MO/v1/User/{userId}/Point', 'Api\VoucherController@point')->name('api.v1.voucher.get.point');
//Retrieve Point History
Route::get('/LM/MO/v1/User/{userId}/Point/History', 'Api\VoucherController@pointHistory')->name('api.v1.voucher.get.point.history');
//Retrieve Voucher List
Route::get('/LM/MO/v1/User/{userId}/Vouchers', 'Api\VoucherController@query')->name('api.v1.voucher.query');
//Retrieve Voucher Detail
Route::get('/LM/MO/v1/User/{userId}/Vouchers/{voucherId}', 'Api\VoucherController@detail')->name('api.v1.voucher.detail');


Route::get('demo', 'Api\UserController@demo');//获取产品详细信息
