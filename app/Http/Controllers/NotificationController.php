<?php

namespace App\Http\Controllers;

use App\Models\DeviceGroup;
use App\Models\MobileUserToken;
use App\Models\Notification;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Curl;
use Log;
use Exception;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    const API_ACCESS_KEY = 'AIzaSyCEkFoRJ_4o-Hv4wWspfiOmVdHjW5gGd6A';

    const FIREBASE_SEND_URL = 'https://fcm.googleapis.com/fcm/send';

    use NotificationTrait;

    public function query()
    {
        $notification = Notification::orderBy('created_at', 'desc')->get();

        return view('notification.manage', ['notification' => $notification]);
    }

    /**
     * 创建页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('notification.create', ['notification' => new Notification()]);
    }

    /**
     * 发送所有设备
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $notification_group_name = 'Chinaaa';

        $registrationId = MobileUserToken::get(['token']);

        $token = array();

        $i = 0;

        foreach ($registrationId as $item) {
            $token[$i] = $item->token;

            $i++;
        }

        //创建设备组
        $operation = 'create';

        $deviceGroup = array($this->operationDeviceGroup($operation, $notification_group_name, $token));
//        var_dump('notification_key:'.$deviceGroup[0]['notification_key']);

        $notification = new Notification();

        $title = trim($request->input('title'));
        if (mb_strlen($title) == 0) {
            $result = 'Send Error';

            return view('notification.create', ['notification' => $notification, 'result' => $result]);
        }

        $message = trim($request->input('message'));
        if (mb_strlen($message) == 0) {
            $result = 'Send Error';

            return view('notification.create', ['notification' => $notification, 'result' => $result]);
        }

//        $deviceGroup = DeviceGroup::orderBy('created_at', 'desc')->first(['notification_key']);

//        $response = array($this->send($deviceGroup->notification_key, $title, $message));

        //群发消息
        $response = array($this->send($deviceGroup[0]['notification_key'], $title, $message));
        Log::info('send device-group response:' . json_encode($response));

        var_dump($response);


        //移除设备组
        $operation = 'remove';

        $removeDeviceGroup = array($this->operationDeviceGroup($operation, $notification_group_name, $token, $deviceGroup[0]['notification_key']));

        dd($removeDeviceGroup);

        $successPer = $response[0]['success'];
        $failurePer = $response[0]['failure'];

        $sendRate = $successPer / ($successPer + $failurePer);

        $notification->title = $title;
        $notification->message = $message;
        $notification->backend_id = session('bk_auth');
        $notification->message_id = 0;
        $notification->send_rate = $sendRate;

        $result = 0;

        try {
            $notification->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store Restaurant exception ,exception:' . $e->getMessage());
        }

        if ($result == 1) {
            return redirect()->route('admin.notification.query');

        }

        return view('notification.create', ['notification' => $notification, 'result' => 'Send Error']);
    }

    /**
     * 发送单一设备
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function sendSingleDevice(Request $request,$userId)
    {
        $userId = intval(trim($userId));

        $notification = new Notification();

        $title = trim($request->input('title'));
        if (mb_strlen($title) == 0) {
            $result = 'Send Error';

            return view('notification.create', ['notification' => $notification, 'result' => $result]);
        }

        $message = trim($request->input('message'));
        if (mb_strlen($message) == 0) {
            $result = 'Send Error';

            return view('notification.create', ['notification' => $notification, 'result' => $result]);
        }

        $mobileUser = MobileUserToken::whereMobileUserId($userId)->first(['token']);
        Log::info('usertoken:'.$mobileUser->token);
        Log::info('title:'.$title);
        Log::info('message:'.$message);

        $response = array($this->send($mobileUser->token, $title, $message));

        Log::info('send single-device response:' . json_encode($response));

        $messageId = $response['results'][0][0]['message_id'];
        if (is_null($messageId)) {
            $result = 'Send Error';

            return view('notification.create', ['notification' => $notification, 'result' => $result]);
        }

        $notification->title = $title;
        $notification->message = $message;
        $notification->backend_id = session('bk_auth');
        $notification->message_id = $messageId;

        $result = 0;

        try {
            $notification->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store Restaurant exception ,exception:' . $e->getMessage());
        }

        if ($result == 1) {
            return redirect()->route('admin.notification.query');

        }

        return view('notification.create', ['notification' => $notification, 'result' => 'Send Error']);
    }

    /**
     * 创建firebase用户组
     *
     * @param $notification_group_name
     * @return int
     */
    public function deviceGroup($notification_group_name)
    {
        $notification_group_name = trim($notification_group_name);

        $operation = 'create';

        $response = array($this->operationDeviceGroup($operation, $notification_group_name));
        Log::info('create device group,response:' . json_encode($response, JSON_UNESCAPED_UNICODE));

        if (array_key_exists('error', $response[0])) {
            return $response[0]['error'];
        }

        $deviceGroup = new DeviceGroup();
        $deviceGroup->notification_key_name = $notification_group_name;
        $deviceGroup->notification_key = $response[0]['notification_key'];

        $result = 0;

        try {
            $deviceGroup->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store device_group exception ,exception:' . $e->getMessage());
        }

        return $result ? 'success' : 'fail';

    }

    public function removeDeviceGroup()
    {
        $notification_group_name = 'CN';

        $notification_key = 'APA91bHCH-uN6vc1nsgDe4bvHxD9N0IN7z6RuXVebBwB27t7QdZougiRFQBC-H_AxDwHEhD6_NWc8Fl-PQXpaQDrfsHGCVUv_FXKRPw_mpUjKMtP9VAoPT4';

        $operation = 'remove';

        $response = array($this->operationDeviceGroup($operation, $notification_group_name, $notification_key));

        dd($response);
    }


}
