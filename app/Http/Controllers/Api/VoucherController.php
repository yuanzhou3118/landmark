<?php

namespace App\Http\Controllers\Api;

use App\Services\CommonService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }

    public function point($userId)
    {
        $userId = intval(trim($userId));
        if ($userId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        return response()->json([
            'PointEarned' => '85',
            'PointRedeemed' => '10',
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function pointHistory($userId)
    {
        $userId = intval(trim($userId));
        if ($userId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $pointsHistory = array();
        $points = array(
            'PointHistId' => '1',
            'Type' => '1',
            'Date' => '1',
            'Point' => '10',
            'Msg' => '个人信息',
        );
        array_push($pointsHistory, $points);

        return response()->json([
            'PointsHistory' => $pointsHistory,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function query($userId)
    {
        $userId = intval(trim($userId));
        if ($userId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $vouchers = array();

        $voucher = array(
            'VoucherId' => '1',
            'Type' => '1',
            'Title' => 'title',
            'QRUrl' => 'http://landmark.hk',
            'Desc' => 'description',
            'Provision' => 'pro',
            'Status' => '1',
        );

        array_push($vouchers, $voucher);

        return response()->json([
            'Vouchers' => $vouchers,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function detail($userId, $voucherId)
    {
        $userId = intval(trim($userId));
        if ($userId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $voucherId = intval(trim($voucherId));
        if ($voucherId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $voucher = array(
            'VoucherId' => '1',
            'Type' => '1',
            'Title' => 'title',
            'QRUrl' => 'http://landmark.hk',
            'Desc' => 'description',
            'Provision' => 'pro',
            'Status' => '1',
        );

        return response()->json([
            'Voucher' => $voucher,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
