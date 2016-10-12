<?php
/**
 * Created by PhpStorm.
 * User: sopzhou
 * Date: 2016/8/15
 * Time: 14:10
 */

namespace App\Traits;

use App\Models\User;
use App\Models\UserMobile;
use App\Models\UserOpenid;
use App\Services\CookieService;
use Log;
use DB;
use Exception;

trait UserTrait
{
    /**
     * 根据用户email查询信息。
     *
     * @param $email
     * @param array $columns
     * @return mixed
     */
    protected function getUserByEmail($email, array $columns = ['*'])
    {
        return User::whereEmail($email)->whereStatus(true)->first($columns);
    }

    /**
     * 根据用户id查询信息。
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    protected function getUserById($id, array $columns = ['*'])
    {
        return User::whereId($id)->whereStatus(true)->first($columns);
    }

    /**
     * 根据email注册用户。
     *
     * @param $email
     * @return int|mixed
     */
    protected function createUserByEmail($email,$title,$firstName,$lastName,$password)
    {
        $user = new User();

        $user->mobile = $email;
        $user->title = $title;
        $user->firstname = $firstName;
        $user->lastname = $lastName;
        $user->password = $password;
        $user->status = true;

        try {

            $user->save();

            return $user->id;
        } catch (Exception $e) {
            Log::error('save user exception,mobile:' . $email . ',exception:' . $e->getMessage());

            return 0;
        }
    }

}