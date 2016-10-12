<?php

namespace App\Http\Controllers\Api;

use App\Services\CommonService;
use App\Services\RegService;
use App\Services\SessionService;
use App\Services\CookieService;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Curl;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

class UserController extends Controller
{
    use UserTrait;
    const FIREBASE_URL = 'https://fcm.googleapis.com/fcm/send';

    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        header('Content-Type: ' . CommonService::CONTENT_TYPE_JSON);

        CommonService::setCrossDomain();
    }

    /**
     * 用户登录接口
     * ErrorCode=-1:Parameter is not valid
     * ErrorCode=1:账号或者密码错误
     * ErrorCode=0:成功
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $email = trim($request->input('Email'));

        if (RegService::verifyEmail($email)) {
            return response()->json(['ErrorCode' => 2, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );//Parameter is not valid
        }

        if ($email != 'test@nurun.com') {
            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => '账号或者密码错误'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );//账号或者密码不对
        }

        $password = trim($request->input('Password'));//password:Qaz123*()

        if (mb_strlen($password) == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );//Parameter is not valid
        }

        if (md5($password . $email) != 'b6c1c1ddaeeb2b923a6283d96babdf20') {
            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => '账号或者密码错误'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );//账号或者密码不对
        }
        $user = [
            'id' => 1,
            'Title' => 'title',
            'Firstname' => 'firstname',
            'Lastname' => 'lastname',
            'Email' => 'test@nurun.com',
            'QRUrl' => 'qr_url',
            'ProfileUrl' => 'profile_url',
            'Addr' => 'address',
            'Tel' => '110',
            'UserTier' => 'sign'
        ];

        return response()->json([
            'data' => $user,
            'ErrorCode' => 0,
            'ErrorMsg' => '无'
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );

//        if (md5($password . $email) != $this->getUserByEmail($email, ['password'])) {
//            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => '账号或者密码错误'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );//账号或者密码不对
//        }

//        $user = $this->getUserByEmail($email, [
//            'id',
//            'title',
//            'firstname',
//            'lastname',
//            'email',
//            'qr_url',
//            'profile_url',
//            'address',
//            'telephone',
//            'user_sign'
//        ]);
//
//        if (is_null($user)) {//注册。
//            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => '账号或者密码错误'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );//账号或者密码不对
//        }
//
//        SessionService::setUser($user->id);
//
//        CookieService::userLogin(1);
//
//        return response()->json([
//            'data' => $user,
//            'ErrorCode' => 0,
//            'ErrorMsg' => '无'
//        ],
//            200,
//            [],
//            JSON_UNESCAPED_UNICODE
//        );
    }

    /**
     * 用户注册接口
     * ErrorCode=-1:Parameter is not valid
     * ErrorCode=1:账号或者密码错误
     * ErrorCode=0:成功
     * ErrorCode=2:注册过了
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $email = trim($request->input('Email'));

        if (RegService::verifyEmail($email)) {
            return response()->json(['ErrorCode' => 5, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $solution = trim($request->input('Solution'));

        if ($solution < 0) {
            return response()->json(['ErrorCode' => 4, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $firstName = trim($request->input('FirstName'));

        if (mb_strlen($firstName) == 0) {
            return response()->json(['ErrorCode' => 3, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $mobile = trim($request->input('Mobile'));

        if (RegService::verifyMobile($mobile)) {
            return response()->json(['ErrorCode' =>2, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $lastName = trim($request->input('LastName'));

        if (mb_strlen($lastName) == 0) {
            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $password = trim($request->input('Password'));

        if (mb_strlen($password) == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $password = md5($password . $email);

        Log::info('save register user message,email:' . $email . ',solution:' . $solution
            . ',firstname:' . $firstName . ',lastname:' . $lastName . ',password:' . $password);

        $data=[
            'UserId'=>1,
            'Solution'=>$solution,
            'FirstName'=>$firstName,
            'LastName'=>$lastName,
            'Email'=>$email,
            'ProfileUrl'=>'',
            'Addr'=>'',
            'Tel'=>$mobile,
            'SpendForNextTier'=>'385fa83537dfff9a7d250bd8754db630',
            'QRUrl'=>'http://landmark.hk',
            'UserTier'=>'7602424513d89cc6d141978a702d344c',
        ];

        return response()->json([
            'data'=>$data,
            'ErrorCode' => 0,
            'ErrorMsg' => ''
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );

        //判断是否已经注册了
//        $user = $this->getUserByEmail($email, ['id']);
//
//        if (!is_null($user)) {
//            return response()->json(['ErrorCode' => 2, 'ErrorMsg' => '已经注册过了'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );
//        }
//
//        $registerStatus = $this->createUserByEmail($email, $title, $firstName, $lastName, $password);//返回user_id
//
//        if ($registerStatus <= 0) {
//            return response()->json(['ErrorCode' => 1, 'ErrorMsg' => '注册失败'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );
//        }
//        SessionService::setUser($registerStatus);
//
//        CookieService::userLogin(1);
//
//        return response()->json(['ErrorCode' => 0, 'ErrorMsg' => '无'],
//            200,
//            [],
//            JSON_UNESCAPED_UNICODE
//        );
    }

    /**
     * 查看用户详细信息
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile($id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        };
        //调用Middleware接口
//        $user = $this->getUserById($id, [
//            'title',
//            'firstname',
//            'lastname',
//            'email',
//            'qr_url',
//            'profile_url',
//            'address',
//            'telephone',
//            'user_sign'
//        ]);
//        if (is_null($user)) {
//            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
//                200,
//                [],
//                JSON_UNESCAPED_UNICODE
//            );
//        }

        $array = [
            'Title' => 'test_title',
            'Firstname' => 'test_firstname',
            'Lastname' => 'test_lastname',
            'Email' => 'test_email',
            'QRUrl' => 'test_qr_url',
            'ProfileUrl' => 'profile_url',
            'Addr' => 'addr',
            'Tel' => 'tel',
            'UserTier' => 'sign'
        ];
        return response()->json([
            'data' => $array,
            'ErrorCode' => 0,
            'ErrorMsg' => '无'
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );

    }

    /**
     * Edit User info through user id
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request, $id)
    {

        $email = trim($request->input('Email'));

        $title = trim($request->input('Title'));

        $firstName = trim($request->input('FirstName'));

        $lastName = trim($request->input('LastName'));

        $profileUrl = trim($request->input('ProfileUrl'));

        $address = trim($request->input('Addr'));

        $telephone = trim($request->input('Tel'));

        $password = trim($request->input('Password'));

        $password = md5($password . $email);

        Log::info('Edit User info through user id,id:' . $id . 'email:' . $email . ',title:' . $title
            . ',firstname:' . $firstName . ',lastname:' . $lastName . ',password:' . $password);

        return response()->json(['ErrorCode' => 0, 'ErrorMsg' => '无'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Create User Preference
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPreference(Request $request, $id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $styleImgUrlList = trim($request->input('ImgUrl'));

        $profile = $request->Profile;

        if (is_null($profile)) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        Log::info('Create User Preference Through User Id,user_id:' . $id . ',img_url:' . $styleImgUrlList);

        return response()->json(['ErrorCode' => 0, 'ErrorMsg' => '无'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );

    }

    /**
     * Edit User Preference
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPreference(Request $request, $id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $styleImgUrlList = trim($request->StyleImgUrlList);

        $profile = trim($request->Profile);

        if (is_null($profile)) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        Log::info('Edit User Preference Through User Id,user_id:' . $id . ',img_url:' . $styleImgUrlList);

        return response()->json(['ErrorCode' => 0, 'ErrorMsg' => '无'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Set user notification token
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function token(Request $request, $id)
    {
        $model = trim($request->input('Model'));

        if (mb_strlen($model) == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $id = intval(trim($id));
        if ($id < 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $token = trim($request->input('Token'));
        if (mb_strlen($token) == 0) {
            return response()->json(['ErrorCode' => -1, 'ErrorMsg' => 'Parameter is not valid'],
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        return response()->json(['ErrorCode' => 0, 'ErrorMsg' => '无'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function demo()
    {
        define('API_ACCESS_KEY', 'AIzaSyCEkFoRJ_4o-Hv4wWspfiOmVdHjW5gGd6A');

        $registrationIds = array('d-1nw4UfEG8:APA91bEiQrJhaNtqsef_WCWWF30AM_7DnPPAPHoaRtmmSV4zV6bi5E3G21rWlt5RZmatuCbwwpGddS5cNvxf317mQztRTylbjo5OphgnLAy8Dk9cOqDQ5qtoyxkSLX0b4jHEmVZyDzNA');
// prep the bundle
        $msg = array
        (
            "title" => "Portugal vs. Denmark",
            "text" => "5 to 1"
        );
        $fields = array
        (
            'to' => $registrationIds,
            'notification' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'

        );

        $ch = Curl::to(self::FIREBASE_URL)
            ->withOption('RETURNTRANSFER', 1)
            ->withOption('SSL_VERIFYPEER', 0)
            ->withOption('POSTFIELDS', json_encode($fields))
            ->withOption('HEADER', $headers)
            ->asJson(true)
            ->withTimeout(60)
            ->post();
        Log::info('get data from FCM,data:' . json_encode($ch, JSON_UNESCAPED_UNICODE));
        return $ch;
    }

    public function byMobile($mobile){
        $mobile = intval(trim($mobile));

        $user = [
            'UserId' => 1,
            'Title' => 'title',
            'FirstName' => 'firstname',
            'LastName' => 'lastname',
            'Email' => 'test@nurun.com',
            'QRUrl' => 'qr_url',
            'ProfileUrl' => 'profile_url',
            'Addr' => 'address',
            'Tel' => '110',
            'UserTier' => 'sign'
        ];

        return response()->json([
            'data' => $user,
            'ErrorCode' => 0,
            'ErrorMsg' => '无'
        ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

}
