<?php

namespace App\Http\Controllers\Api;

use App\Services\CommonService;
use App\Traits\PSTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PSController extends Controller
{
    use PSTrait;

    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }

    /**
     *
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMsg(Request $request, $id)
    {
        $id = intval(trim($id));
        if ($id == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                ['application/json; charset=utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }

        $type = trim($request->input('type'));

        $result = -1;

        if (mb_strlen($type) == 0) {
            return response()->json(
                ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
        }
        switch ($type) {
            case 'Msg':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
                };
                $result = $this->sendMsgByType('Msg', $msg, '');
                break;
            case 'AvailReq':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
                };
                $productList = trim($request->input('product_list'));
                $result = $this->sendMsgByType('AvailReq', $msg, $productList);
                break;
            case 'AvailConfirm':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
                };
                $productList = trim($request->input('product_list'));
                $result = $this->sendMsgByType('AvailConfirm', $msg, $productList);
                break;
            case 'PSReq':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
                };
                $req = trim($request->input('req'));
                $result = $this->sendMsgByType('PSReq', $msg, $req);
                break;
            case 'PSRep':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, ['application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
                };
                $recommendation = trim($request->input('recommendation'));
                $result = $this->sendMsgByType('PSRep', $msg, $recommendation);
                break;
            case 'APSug':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, ['application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
                };
                $timeSlot = trim($request->input('time_slot'));
                $result = $this->sendMsgByType('APSug', $msg, $timeSlot);
                break;
            case 'ApConfirm':
                $msg = trim($request->input('msg'));
                if (mb_strlen($msg) == 0) {
                    return response()->json(
                        ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, ['application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
                };
                $timestamp = trim($request->input('timestamp'));

                $result = $this->sendMsgByType('ApConfirm', $msg, $timestamp);
                break;
            default:
                break;
        }
        $error_msg = '无';
        switch ($result) {
            case 0:
                $error_msg = '无';
                break;
            case 1:
                $error_msg = '失败';
                break;
            default;
                break;
        }
        return response()->json(
            ['ErrorCode' => $result, 'ErrorMsg' => $error_msg], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }

    public function queryMsg($id)
    {
        $id = intval(trim($id));
        if ($id == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                ['application/json; charset=utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }

        $result = $this->getMsgByid($id);
        if (is_null($result)) {
            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => '失败'],
                200,
                ['application/json; charset=utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }
        return response()->json(
            [
                'ErrorCode' => 0,
                'ErrorMsg' => '无',
                'data' => $result
            ],
            200,
            ['application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
