<?php

namespace App\Http\Controllers\Api;

use App\Services\CommonService;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }

    public function addProduct($id, $productId)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $productId = intval(trim($productId));
        if ($productId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        return response()->json(
            [
                'WishId' => 1,
                'ErrorCode' => 0,
                'ErrorMsg' => '无'
            ], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }

    public function delete($userid, $productId)
    {
        $userid = intval(trim($userid));
        if ($userid < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $productId = intval(trim($productId));
        if ($productId < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        return response()->json(
            [
                'WishId' => 1,
                'ErrorCode' => 0,
                'ErrorMsg' => '无'
            ], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }

    public function query($userid)
    {
        $userid = intval(trim($userid));

        if ($userid < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $productList = [
            'ProductId' => 'product_id',
            'ThumbUrl' => 'thumb_url',
            'Brand' => 'brand',
            'ProductName' => 'product_name',
            'ProductUrl' => 'product_url',
            'BrandLogoUrl' => 'brand_logo_url',
            'IsExclusive' => 'is_exclusive',
            'CreateDate' => 'create_date',
            'ModifyDate' => 'modify_date',
        ];

        return response()->json([
            'ProductList' => $productList,
            'ErrorCode' => 0,
            'ErrorMsg' => '无'
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
