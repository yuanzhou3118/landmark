<?php

namespace App\Http\Controllers;

use App\Models\BackendUser;
use App\Services\RegService;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class UserManagementController extends Controller
{

    /**
     * user management index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query()
    {
        $backendUserId = session('bk_auth');

        $backendUse = BackendUser::whereId($backendUserId)->first(['role_id']);
//        return view('usermanagement.manage', ['user' => $backendUse]);

        $query = DB::table('backend_users')
            ->join('roles', 'roles.id', '=', 'backend_users.role_id')
            ->where('backend_users.id', '!=', session('bk_auth'));

        switch ($backendUse->role_id) {
            case 1:
                $query = $query->orderBy('backend_users.role_id');
                break;
            case 2:
                $query = $query->where('backend_users.role_id', '>', '1')->orderBy('backend_users.role_id');
                break;
            case 3:
                $query = $query->where('backend_users.role_id', '>', '2')->orderBy('backend_users.role_id');
                break;
        }
        $user = $query->get([
            'backend_users.id',
            'backend_users.account',
            'roles.desc',
        ]);

        return view('usermanagement.manage', ['user' => $user]);
    }

    public function edit($id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return redirect()->route('admin.user.query');
        }

        $backendUser = BackendUser::whereId($id)->first();

        return view('usermanagement.edit', ['user' => $backendUser]);
    }

    public function update(Request $request, $id)
    {
        $backendUserId = intval(trim($id));

        $backendUser = BackendUser::whereId($backendUserId)->first();

        if (is_null($backendUser)) {
            return redirect()->route('admin.user.query');
        }

        $username = trim($request->input('name'));
        if (mb_strlen($username) == 0) {
            $result = 'Save Error';

            return view('usermanagement.edit', ['user' => $backendUser, 'result' => $result]);
        }

        $account = trim($request->input('account'));
        if (mb_strlen($account) == 0) {
            $result = 'Save Error';

            return view('usermanagement.edit', ['user' => $backendUser, 'result' => $result]);
        }

        $password = trim($request->input('password'));
        if (mb_strlen($password) == 0) {
            $result = 'Save Error';

            return view('usermanagement.edit', ['user' => $backendUser, 'result' => $result]);
        }

        $role_id = trim($request->input('admin_type'));
        if (mb_strlen($role_id) == 0) {
            $result = 'Save Error';

            return view('usermanagement.edit', ['user' => $backendUser, 'result' => $result]);
        }

        $backendUser->username = $username;
        $backendUser->account = $account;
        $backendUser->password = $password;
        $backendUser->role_id = $role_id;

        $result = 0;

        try {
            $backendUser->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('update UserManagement exception,backend_users_id' . $id . ',exception:' . $e->getMessage());
        }
        if($result == 1){
            return redirect()->route('admin.user.query');
        }

        return view('usermanagement.edit', ['user' => $backendUser, 'result' => 'Save Error']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $backendUser = BackendUser::whereId($id)->first();

        if (is_null($backendUser)) {
            return redirect()->route('admin.user.query');
        }

        $result = 'Delete Error';

        try {
            $backendUser::destroy($id);

            $result = 'Delete Success';
        } catch (Exception $e) {
            Log::error('delete UserManagement exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('usermanagement.delete', ['result' => $result]);
    }

    public function create()
    {
        $backendId = session('bk_auth');
        $roleId = BackendUser::whereId($backendId)->first(['role_id']);

        return view('usermanagement.create', ['user' => new BackendUser(), 'role_id' => $roleId->role_id]);
    }

    public function store(Request $request)
    {
        $backendId = session('bk_auth');
        $roleId = BackendUser::whereId($backendId)->first(['role_id']);
        $backendUser = new BackendUser();

        $username = trim($request->input('name'));
        if (mb_strlen($username) == 0) {
            $result = 'Add Error';

            return view('usermanagement.create', ['user' => $backendUser, 'result' => $result, 'role_id' => $roleId->role_id]);
        }

        $account = trim($request->input('account'));
        $checkAccount = BackendUser::whereAccount($account)->first();
        if ((mb_strlen($account) == 0 )||(!is_null($checkAccount))) {
            $result = 'Add Error';

            return view('usermanagement.create', ['user' => $backendUser, 'result' => $result, 'role_id' => $roleId->role_id]);
        }
        if(RegService::verifyEmail($account)){
            $result = 'Add Error';

            return view('usermanagement.create', ['user' => $backendUser, 'result' => $result, 'role_id' => $roleId->role_id]);
        }

        $password = trim($request->input('password'));
        if (mb_strlen($password) == 0) {
            $result = 'Add Error';

            return view('usermanagement.create', ['user' => $backendUser, 'result' => $result, 'role_id' => $roleId->role_id]);
        }

        $role_id = trim($request->input('admin_type'));
        if (mb_strlen($role_id) == 0) {
            $result = 'Add Error';

            return view('usermanagement.create', ['user' => $backendUser, 'result' => $result, 'role_id' => $roleId->role_id]);
        }

        $backendUser->username = $username;
        $backendUser->account = $account;
        $backendUser->password = $password;
        $backendUser->role_id = $role_id;

        $result = 0;

        try {
            $backendUser->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store UserManagement exception ,exception:' . $e->getMessage());
        }

        if($result == 1){
            return redirect()->route('admin.user.query');
        }

        return view('usermanagement.create', ['user' => $backendUser, 'result' => 'Add Error', 'role_id' => $roleId->role_id]);
    }
}
