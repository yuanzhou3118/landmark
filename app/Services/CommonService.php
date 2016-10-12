<?php
/**
 * Created by PhpStorm.
 * User: xinkui.huang
 * Date: 2016-07-08
 * Time: 15:53
 */

namespace App\Services;

class CommonService
{
    /**
     * 返回json的头信息。
     */
    const CONTENT_TYPE_JSON = 'application/json; charset=utf-8';

    /**
     * 默认每页条数。
     */
    const PAGE_DEFAULT_SIZE = 5;


    /**
     * 获取日期的时间戳。
     *
     * @param null $date
     * @return int
     */
    public static function getDay($date = null)
    {
        if (!is_null($date)) {
            return strtotime(date('Y-m-d', strtotime($date)));
        }

        return strtotime(date('Y-m-d'));
    }

    /**
     * 验证是否是正式环境。
     *
     * @return bool
     */
    public static function checkEnv()
    {
        return strcasecmp(app()->environment(), 'production') == 0;
    }

    /**
     * 验证是否是日期格式字符串。
     *
     * @param $date
     * @return bool
     */
    public static function isDate($date)
    {
        return strtotime(date('Y-m-d', strtotime($date))) === strtotime($date);
    }

    /**
     * 设置允许跨域。
     */
    public static function setCrossDomain()
    {
        if(!static::checkEnv()){
            header('Access-Control-Allow-Origin: http://test100.nurunci.com');

            header('Access-Control-Allow-Credentials: true');

            header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        }
    }
}