<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\BackendUser
 *
 * @property integer $id
 * @property string $account
 * @property string $pwd
 * @property boolean $status
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereAccount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser wherePwd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereUpdatedAt($value)
 * @property string $username
 * @property string $password
 * @property integer $role_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BackendUser whereRoleId($value)
 */
class BackendUser extends Model
{
    protected $table = 'backend_users';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
