<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingLog;
use App\Models\BookingStatus;
use App\Models\Notification;
use Illuminate\Http\Request;
use Exception;
use Log;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    public function manage()
    {
        return view('booking.manage');
    }

    /**
     * user management index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query(Request $request)
    {
        $states = trim($request->states);

//        $bookingCode = Booking::groupBy('booking_code')->get(['booking_code']);
        $query = DB::table('bookings');

        if (!preg_match('/^0|100$/', $states)){
            return response()->json(['result' => 20]);
        }
        if($states == 0){
            $query = $query->where('status','0');
        }

        $bookingCode = $query->groupBy('booking_code')->get(['booking_code']);

        if (is_null($bookingCode)) {
            return response()->json(['result' => 0]);
        }

        $booking = [];
        $i = 0;
        foreach ($bookingCode as $item) {
            $booking[$i] = Booking::whereBookingCode($item->booking_code)->orderBy('created_at', 'desc')->first();
            $i++;
        }
        return response()->json(['booking' => $booking, 'result' => 1]);
    }

    public function detail($bookingCode)
    {
        $bookingCode = trim($bookingCode);
        if ($bookingCode < 0) {
            return redirect()->route('admin.booking.query');
        }

        $booking = Booking::whereBookingCode($bookingCode)->orderBy('created_at', 'desc')->first();

        $bookingLog = BookingLog::whereBookingCode($bookingCode)
            ->whereUserId($booking->mobile_user_id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('booking.edit', ['booking' => $booking, 'booking_log' => $bookingLog]);
    }

    /**
     * 更新booking状态
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request)
    {
        $bookingCode = trim($request->input('booking_code'));
        if (mb_strlen($bookingCode) < 0) {
            return response()->json(['result' => 0]);
        }

        $booking = booking::whereBookingCode($bookingCode)->orderBy('created_at', 'desc')->first();
        if (is_null($booking)) {
            return response()->json(['result' => 0]);
        }

        if (is_null($booking)) {
            return redirect()->route('admin.booking.query');
        }

        $status = intval(trim($request->input('status')));
        if (mb_strlen($status) < 0) {
            return response()->json(['result' => 0]);
        }

        $booking->status = $status;

        $bookingStatus = new BookingStatus();
        $bookingStatus->booking_code = $bookingCode;
        $bookingStatus->status = $status;
        $bookingStatus->backend_user_id = session('bk_auth');

        DB::beginTransaction();

        $result = 0;

        try {
            $booking->save();
            $bookingStatus->save();
            DB::commit();
            $result = 1;

        } catch (Exception $e) {
            Log::error('store booking exception ,exception:' . $e->getMessage());
            DB::rollBack();
        }

        return response()->json(['result' => $result]);
    }


    /**
     * 保存booking的log
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLog(Request $request)
    {
        $newBookingLog = new BookingLog();

        $bookingCode = trim($request->input('booking_code'));
        if (mb_strlen($bookingCode) > 20) {
            return response()->json(['result' => 0]);
        }
        $userId = intval(trim($request->input('user_id')));
        if ($userId < 1) {
            return response()->json(['result' => 2]);
        }

        $content = trim($request->input('content'));
        if (mb_strlen($content) == 0) {
            return response()->json(['result' => 3]);
        }

        $newBookingLog->content = $content;
        $newBookingLog->booking_code = $bookingCode;
        $newBookingLog->user_id = $userId;

        $result = 0;

        try {
            $newBookingLog->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store booking exception ,exception:' . $e->getMessage());
        }

        return response()->json(['result' => $result]);
    }

    public function createNotification($id,$status){

        return view('booking.send', ['notification' => new Notification(),'userId'=>$id,'status'=>$status]);
    }
}
