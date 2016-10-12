<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\MobileUserToken
 *
 * @property integer $id
 * @property integer $mobile_user_id
 * @property string $language
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MobileUserToken whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MobileUserToken whereMobileUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MobileUserToken whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MobileUserToken whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MobileUserToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MobileUserToken whereUpdatedAt($value)
 */
class MobileUserToken extends Model
{
    protected $table = 'mobile_user_tokens';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
