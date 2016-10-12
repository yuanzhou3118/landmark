<?php
/**
 * Created by PhpStorm.
 * User: xinkui.huang
 * Date: 2016-07-12
 * Time: 10:36
 */

namespace App\Services;

class SessionService
{
    const USER_ID = 'user_id';

    /**
     * 登陆后设置用户id的session。
     *
     * @param $userId
     */
    public static function setUser($userId){
        session([self::USER_ID => $userId]);
    }

    /**
     * 获取登陆用户的id。
     *
     * @return int
     */
    public static function getUser()
    {
        return intval(session(self::USER_ID));
    }

}
