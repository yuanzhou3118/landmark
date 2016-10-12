<?php

namespace App\Http\Controllers\Api;

use App\Services\CommonService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * constructor.
     */
    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }


    public function uploadImg(Request $request)
    {
        $method = trim($request->input('Upload'));
        $img = trim($request->input('Image'));
        $type = trim($request->input('Type'));
        $width = trim($request->input('Width'));
        $height = trim($request->input('Height'));

        if (mb_strlen($method) == 0) {
            return response()->json(
                ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
        };

        if (mb_strlen($img) == 0) {
            return response()->json(
                ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
        };

        if (mb_strlen($type) == 0) {
            return response()->json(
                ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
        };

        if (mb_strlen($width) == 0) {
            return response()->json(
                ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
        };

        if (mb_strlen($height) == 0) {
            return response()->json(
                ['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'], 200, [], JSON_UNESCAPED_UNICODE);
        };

        return response()->json(
            [
                'UserId' => 1,
                'ErrorCode' => 0,
                'ErrorMsg' => '无'
            ], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }
    public function getImgDetail(){

        return response()->json(
            [
                'Img' => 'http://res.mohou.com/images/new/cloud-show/tixing.jpg',
                'Type' => 'url',
                'Width' => 58,
                'Height' => 58,
            ], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }
}
