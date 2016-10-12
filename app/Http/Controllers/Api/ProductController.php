<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Services\CommonService;
use App\Traits\ProductTrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTrait;

    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }

    public function query()
    {
        $productList = [
            'ProductId' => 1,
            'ThumbUrl' => 'http://landmark.hk',
            'Brand' => 'brand',
            'ProductName' => '衣服',
            'ProductUrl' => '/yifu/1',
            'BrandLogoUrl' => '/yifu_logo.jpg',
            'IsExclusive' => '1',
            'CreateDate' => '2016-09-01 10:21:10',
            'ModifyDate' => '2016-09-01 10:21:10'
        ];

        return response()->json([
            'productList' => $productList,
            'ErrorCode' => 0,
            'ErrorMsg' => '无'
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function detail($id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $product = $this->getProductById($id, [
            'thumb_url',
            'image_url',
            'brand',
            'product_name',
            'product_url',
            'brand_logo_url',
        ]);
        if (is_null($product)) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        return response()->json([
            'data' => $product,
            'ErrorCode' => 0,
            'ErrorMsg' => '无'
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }


    public function byProduct(Request $request)
    {
        $productId = intval(trim($request->input('ProductId')));
        if ($productId < 0) {
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
