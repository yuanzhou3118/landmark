<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\BookingLog;
use App\Models\BookingStatus;
use App\Models\Restaurant;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Exception;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class FNBController extends Controller
{

    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }

    /**
     * Retrieve shop info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request)
    {
        $query = DB::table('restaurants')->where('active', 1);

        $lang = trim($request->input('Lang'));

//        $restaurant = Restaurant::whereActive(1)->orderBy('created_at')->get();

        $restaurant = $query
            ->orderBy('created_at')
            ->get();

        $resultData = [];

        foreach ($restaurant as $item) {
            $image_url = e($item->image_url);
            $imageArr = explode(";", $image_url);
            $bookinghrs = json_decode($item->booking_hours);
            $booking_hours = implode(',', $bookinghrs);

            $sc_title = $item->sc_title;
            $tc_title = $item->tc_title;
            $sc_description = $item->sc_description;
            $tc_description = $item->tc_description;
            if (preg_match('/sc|tc/i', $lang)) {
                $title = preg_match('/sc/i', $lang) ? $sc_title : $tc_title;
                Log::info('lang:' . $lang . ',title:' . $title);
                $description = preg_match('/sc/i', $lang) ? $sc_description : $tc_description;
            } else {
                $title = $item->en_title;
                $description = $item->en_description;
            }

            Log::info('lang:' . $lang . ',title:' . $title . ',description:' . $description);

            array_push($resultData, [
                'ShopId' => $item->id,
                'Name' => $item->name,
                'OpenHrs' => $item->open_hours,
                'BookingHrs' => $booking_hours,
                'SlideImages' => $imageArr,
                'SlideTitle' => $title,
                'Description' => $description,
                'ContactNumber' => $item->contact_phone,
                'Location' => $item->location,
                'LogoUrl' => $item->logo_url,
                'Tags' => $item->tag,
            ]);
        }

        return response()->json([
            'Data' => $resultData,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );

    }

    /**
     * Priority Booking
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function priorityBooking(Request $request, $userId)
    {
        $userId = intval(trim($userId));
        if ($userId < 1) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $firstName = trim($request->input('FirstName'));

        $lastName = trim($request->input('LastName'));

        $restaurantId = trim($request->input('ShopId'));

        if ($restaurantId < 1) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $restaurant = Restaurant::whereId($restaurantId)->first(['name', 'booking_type']);
        if (is_null($restaurant)) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $adults = intval(trim($request->input('Adults')));
        if ($adults < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $children = intval(trim($request->input('Children')));
        if ($children < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $date = trim($request->input('Time'));
        if (mb_strlen($date) == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $bookingTime = date('mdHisB');
        $random = mt_rand(100, 999);
        $specialReq = trim($request->input('SpecialReq'));

        $booking = new Booking();
        $booking->mobile_user_id = $userId;
        $booking->customer_firstname = $firstName;
        $booking->customer_lastname = $lastName;
        $booking->restaurant_id = $restaurantId;
        $booking->restaurant_name = $restaurant->name;
        $booking->time = $date;
        $booking->adult = $adults;
        $booking->children = $children;
        $booking->booking_type = $restaurant->booking_type;
        $booking->special_req = $specialReq;
        $booking->booking_code = $bookingTime . $random . $userId;

        $errorCode = 1;
        $errorMsg = '保存失败';
        try {
            $booking->save();

            $errorCode = 0;
            $errorMsg = '';
        } catch (Exception $e) {
            Log::error('api FNBController Priority Booking exception ,exception:' . $e->getMessage());
        }

        return response()->json([
            'BookingId' => $booking->id,
            'BookingCode' => $booking->booking_code,
            'ErrorCode' => $errorCode,
            'ErrorMsg' => $errorMsg
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

//    public function bookingCode($bookingId)
//    {
//        $bookingTime = date('YmdHi');
//        $id = $bookingId;
//
//        if (mb_strlen($bookingId) < 4) {
//            switch (mb_strlen($bookingId)) {
//                case 1:
//                    $bookingId = '000' . $bookingId;
//                    break;
//                case 2:
//                    $bookingId = '00' . $bookingId;
//                    break;
//                case 3:
//                    $bookingId = '0' . $bookingId;
//                    break;
//                default:
//                    break;
//            }
//        }
//        $bookingCode = Booking::whereId($id)->first();
//        $bookingCode->booking_code = $bookingTime . $bookingId;
//        $errorCode = 1;
//        try {
//            $bookingCode->save();
//
//            $errorCode = 0;
//        } catch (Exception $e) {
//            Log::error('api FNBController bookingCode exception ,exception:' . $e->getMessage());
//        }
//
//        return $errorCode;
//    }

    /**
     * Booking List
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBookingList(Request $request, $userId)
    {
        $userId = intval(trim($userId));
        if ($userId < 1) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $query = DB::table('bookings')->where('mobile_user_id', $userId);

        $pageIndex = trim($request->input('From'));
        if (empty($pageIndex)) {
            $pageIndex = 0;
        }

        $pageSize = trim($request->input('Limit'));
        if (empty($pageSize)) {
            $pageSize = 10;
        }
        $sortBy = trim($request->input('Sortby'));

        $orderBy = trim($request->input('Order'));//顺序或者倒序

        if ($sortBy == 'createDate') {
            $query = $query->orderBy('created_at', 'desc');
        }
        Log::info($sortBy);
        $countQuery = $query;
        $totalCount = $countQuery->count();

        if ($totalCount == 0) {
            return response()->json([
                'ErrorCode' => 2,
                'ErrorMsg' => 'Data is empty'
            ],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        if (($pageIndex - 1) * $pageSize >= $totalCount) {
            return response()->json([
                'ErrorCode' => 2,
                'ErrorMsg' => 'Parameter is not valid'
            ],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        if ($totalCount < $pageSize)
            $pageSize = $totalCount;

        $booking = $query
            ->orderBy('time', 'desc')
            ->skip($pageSize * ($pageIndex - 1))
            ->take($pageSize)
            ->get();

//        $booking = Booking::whereMobileUserId($userId)->orderBy('created_at')->get();

        $resultData = [];

        foreach ($booking as $item) {
            array_push($resultData, [
                'BookingId' => $item->id,
                'ShopId' => $item->restaurant_id,
                'Name' => $item->restaurant_name,
                'Adults' => $item->adult,
                'Children' => $item->children,
                'Date' => $item->time,
                'Time' => $item->time,
                'Status' => $item->status,
            ]);
        }

        return response()->json([
            'Bookings' => $resultData,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * update booking
     *
     * @param Request $request
     * @param $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePriority(Request $request, $bookingId)
    {
        $bookingId = intval(trim($bookingId));
        if ($bookingId < 1) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $booking = Booking::whereId($bookingId)->first();
        if (is_null($booking)) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

//        $restaurantId = intval(trim($request->input('ShopId')));
//        if ($restaurantId < 1) {
//            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );
//        }
//        $restaurant = Restaurant::whereId($restaurantId)->first(['name', 'booking_type']);
//        if(is_null($restaurant)){
//            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );
//        }

        $adults = intval(trim($request->input('Adults')));
        if ($adults < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $children = intval(trim($request->input('Children')));
        if ($children < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $time = trim($request->input('Time'));

        $status = intval(trim($request->input('Status')));
        if ($status < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $specialReq = trim($request->input('SpecialReq'));

        $newBooking = new Booking();
        $newBooking->mobile_user_id = $booking->mobile_user_id;
        $newBooking->booking_code = $booking->booking_code;
        $newBooking->restaurant_id = $booking->restaurant_id;
        $newBooking->restaurant_name = $booking->restaurant_name;
        $newBooking->time = mb_strlen($time) ? $time : $booking->time;
        $newBooking->adult = mb_strlen($adults) ? $adults : $booking->adult;
        $newBooking->children = mb_strlen($children) ? $children : $booking->children;
        $newBooking->booking_type = $booking->booking_type;
        $newBooking->special_req = mb_strlen($specialReq) ? $specialReq : $booking->specialReq;
        $newBooking->status = $status;

        $newBookingLog = new BookingLog();

        $newBookingLog->booking_code = $booking->booking_code;
        $newBookingLog->content = 'Your reservation request has been updated, we will get back to you within 24 hours.';
        $newBookingLog->user_id = $booking->mobile_user_id;

//        $bookingStatus = new BookingStatus();
//        $bookingStatus->booking_code = $booking->booking_code;
//        $bookingStatus->status = $status;
//        $bookingStatus->backend_user_id = 0;

        $errorCode = 1;
        $errorMsg = '保存失败';

        DB::beginTransaction();

        try {
            $newBooking->save();
//            $bookingStatus->save();
            $newBookingLog->save();

            DB::commit();

            $errorCode = 0;
            $errorMsg = '';
        } catch (Exception $e) {
            Log::error('api FNBController Update Booking exception ,exception:' . $e->getMessage());

            DB::rollBack();
        }

        $bookingLogList = BookingLog::orderBy('created_at')->get(['content', 'created_at']);

        if ($newBooking->status == 0) {
            $status = 'pending';
        }
        if ($newBooking->status == 1) {
            $status = 'confirmed';
        }
        if ($newBooking->status == 2) {
            $status = 'canceled';
        }
        if ($newBooking->status == 3) {
            $status = 'user cancel';
        }


        return response()->json([
            'BookingId' => $booking->id,
            'BookingCode' => $booking->booking_code,
            'Status' => $status,
            'Logs' => $bookingLogList,
            'ErrorCode' => $errorCode,
            'ErrorMsg' => $errorMsg
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取booking动态
     *
     * @param $bookingCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus($bookingCode)
    {
        $bookingCode = trim($bookingCode);
        Log::info($bookingCode.','.mb_strlen($bookingCode));
        if ($bookingCode < 1 || mb_strlen($bookingCode) < 12) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $bookingCode = Booking::whereBookingCode($bookingCode)->orderBy('created_at','desc')->first();
        if (is_null($bookingCode)) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $bookingLogList = BookingLog::orderBy('created_at')->get(['content', 'created_at']);

        if ($bookingCode->status == 0) {
            $status = 'pending';
        }
        if ($bookingCode->status == 1) {
            $status = 'confirmed';
        }
        if ($bookingCode->status == 2) {
            $status = 'canceled';
        }
        if ($bookingCode->status == 3) {
            $status = 'user cancel';
        }

        $data = array([
            "BookingId" => $bookingCode->id,
            "BookingCode" => $bookingCode->booking_code,
            "ShopId" => $bookingCode->restaurant_id,
            "Name" => $bookingCode->restaurant_name,
            "Adults" => $bookingCode->adult,
            "Children" => $bookingCode->children,
            "ReserveTime" => $bookingCode->time,
            "Create" => e($bookingCode->created_at),
            "Status" => $status,
            "Logs" => $bookingLogList
        ]);


//        $bookingStatus = BookingStatus::whereBookingCode($bookingCode)->orderBy('created_at')->get();
//        if (is_null($bookingStatus)) {
//            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );
//        }
//
//        $resultData = [];
//
//        foreach ($bookingStatus as $item) {
//            array_push($resultData, [
//                'Status' => $item->status,
//                'Time' => strtotime($item->created_at),
//            ]);
//        }


        return response()->json([
            'Data' => $data,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

}
