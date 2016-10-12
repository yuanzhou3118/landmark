<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\BackendUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class AdminController extends Controller
{
    /**
     * 维护后台主页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.welcome');
    }

    /**
     * 后台登录页面。
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('backend.login', ['backend_user' => new BackendUser()]);
    }

    /**
     * 后台用户登录接口。
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function doLogin(Request $request)
    {
        $account = trim($request->input('account'));

        $password = trim($request->input('password'));

        $backendUser = new BackendUser();

        $backendUser->account = $account;
        $backendUser->password = $password;

        $msg = '';

        if (mb_strlen($account) == 0) {
            $msg = '用户名不能为空';
        } elseif (mb_strlen($password) == 0) {
            $msg = '密码不能为空';
        }

        if (mb_strlen($msg) > 0) {
            return view('admin.login', ['backend_user' => $backendUser, 'result' => $msg]);
        }

        $backendUser = BackendUser::whereAccount($account)->first();

        if (is_null($backendUser) || $backendUser->password != $password) {
            $backendUser = new BackendUser();

            $backendUser->account = $account;
            $backendUser->password = $password;

            return view('admin.login', ['backend_user' => $backendUser, 'result' => '用户名或密码不正确']);
        }

        session(['bk_auth' => $backendUser->id, 'bk_name' => $backendUser->username]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * 后台用户登出接口。
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout()
    {
        Session::clear();

        return redirect()->route('admin.login');
    }

}
