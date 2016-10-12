<?php
/**
 * Created by PhpStorm.
 * User: sopzhou
 * Date: 2016/8/15
 * Time: 16:47
 */

namespace App\Traits;

use App\Models\MobileUserToken;
use Log;

trait NotificationTrait
{
    /**
     * 发送notification到设备
     *
     * @param $registration_ids
     * @param $title
     * @param $message
     * @return mixed
     */
    protected function send($registration_ids, $title, $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $access_key = 'AIzaSyCEkFoRJ_4o-Hv4wWspfiOmVdHjW5gGd6A';

        Log::info('notificationTrait send notification_key:' . $registration_ids);

        $headers = array
        (
            'Authorization: key=' . $access_key,
            'Content-Type: application/json'
        );

        $msg = array
        (
            'title' => $title,
            'text' => $message
        );
        $fields = array
        (
            'to' => $registration_ids,
            'notification' => $msg,
            'priority' => 'high'
        );

        $result = $this->post_curl($url, $fields, $headers);

        Log::info('send notification,result:' . json_encode($result, JSON_UNESCAPED_UNICODE));

        return $result;

    }

    protected function operationDeviceGroup($operation, $notification_group_name,array $token, $notification_key = null)
    {
        $url = 'https://android.googleapis.com/gcm/notification';

        $access_key = 'AIzaSyCEkFoRJ_4o-Hv4wWspfiOmVdHjW5gGd6A';

        $sendId = 469891853214;

        $headers = array
        (
            'Authorization: key=' . $access_key,
            'Content-Type: application/json',
            'project_id:' . $sendId
        );

        if ($notification_key == null) {
            $fields = array
            (
                'operation' => $operation,
                'notification_key_name' => $notification_group_name,
                'registration_ids' => $token
            );
        } else {
            $fields = array
            (
                'operation' => $operation,
                'notification_key_name' => $notification_group_name,
                'notification_key' => $notification_key,
                'registration_ids' => $token
            );
        }

        $result = $this->post_curl($url, $fields, $headers);

        Log::info('operation notification,result:' . json_encode($result, JSON_UNESCAPED_UNICODE));

        return $result;
    }


    protected function post_curl($url, array $data, array $headers)
    {
        error_log('send post_curl to ankechen, data:' . json_encode($data));

        $jsonData = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true, JSON_UNESCAPED_UNICODE);
    }

}