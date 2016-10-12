<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function query()
    {
        $news = [
            'Title' => 'title',
            'ImgUrl' => 'imgurl',
            'NewsId' => 'newsid',
            'NewsUrl' => 'news_url',
            'Date' => 'date',
            'Short Desc' => 'short desc',
            'Tier' => 'tier',
        ];

        return response()->json(
            [
                'NewsList' => $news,
                'ErrorCode' => 0,
                'ErrorMsg' => '无'
            ], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }
    public function detail(){
        return response()->json(
            [
                'Title' => 'title',
                'ImgUrl' => 'imgurl',
                'NewsId' => 'newsid',
                'NewsUrl' => 'newsurl',
                'Date' => 'date',
                'Short Desc' => 'short desc',
                'Tier Desc' => 'tier desc',
                'ErrorCode' => 0,
                'ErrorMsg' => '无'
            ], 200, []
            , JSON_UNESCAPED_UNICODE
        );
    }
}
