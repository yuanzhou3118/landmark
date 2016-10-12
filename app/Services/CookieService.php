<?php
/**
 * Created by PhpStorm.
 * User: xinkui.huang
 * Date: 2016-07-08
 * Time: 17:22
 */

namespace App\Services;

class CookieService
{
    /**
     * cookie默认的过期时间。
     */
    const COOKIE_EXPIRE = 60 * 60 * 2;

    /**
     * 用户登陆状态的cookie名称。
     */
    const COOKIE_DIGIWINE_LOGIN = 'landmark_login';

    /**
     * 用户是否绑定mobile的cookie名称。
     */
    const COOKIE_DIGIWINE_EMAIL = 'landmark_email';

    /**
     * @return null|string
     */
    public static function setDomain()
    {
        return strcasecmp(app()->environment(),  'production') != 0 ? '.nurunci.com' : null;
    }

    /**
     * 添加cookie。
     *
     * @param $name
     * @param $value
     */
    public static function addCookie($name, $value)
    {
        setcookie($name, urlencode($value), time() + self::COOKIE_EXPIRE, '/', static::setDomain());
    }

    /**
     * 删除cookie。
     *
     * @param $name
     */
    public static function delCookie($name)
    {
        setcookie($name, null, time() - self::COOKIE_EXPIRE, '/', static::setDomain());
    }

    /**
     * 添加登陆后的cookie
     *
     * @param $hasEmail
     */
    public static function userLogin($hasEmail)
    {
        static::addCookie(self::COOKIE_DIGIWINE_LOGIN, 1);

        static::addCookie(self::COOKIE_DIGIWINE_EMAIL, $hasEmail);
    }

    /**
     * 退出登陆时删除cookie。
     */
    public static function userLogout()
    {
        static::delCookie(self::COOKIE_DIGIWINE_LOGIN);

        static::delCookie(self::COOKIE_DIGIWINE_EMAIL);
    }

    /**
     * 更新用户绑定email的cookie。
     */
    public static function userBindingMobile()
    {
        static::addCookie(self::COOKIE_DIGIWINE_EMAIL, 1);
    }

}
