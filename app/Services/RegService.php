<?php

/**
 * Created by PhpStorm.
 * User: sopzhou
 * Date: 2016/8/15
 * Time: 13:45
 */
namespace App\Services;

class RegService
{
    /**
     * 手机号正则。
     */
    const MOBILE_REG = '/^1[34578]\d{9}$/';

    const EMAIL_REG = '/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/';


    /**
     * 性别正则。
     */
    const GENDER_REG = '/^(0|1)$/';

    /**
     * 验证email是否合法。
     *
     * @param $mergeType
     * @return bool
     */
    public static function verifyEmail($mergeType)
    {
        return !preg_match(self::EMAIL_REG, $mergeType);
    }

    /**
     * 验证email是否合法。
     *
     * @param $mergeType
     * @return bool
     */
    public static function verifyMobile($mergeType)
    {
        return !preg_match(self::MOBILE_REG, $mergeType);
    }
}

