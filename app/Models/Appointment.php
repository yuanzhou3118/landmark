<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Appointment
 *
 * @property integer $id
 * @property string $location
 * @property boolean $room_id
 * @property string $date
 * @property boolean $time_from
 * @property boolean $time_to
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereRoomId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereTimeFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereTimeTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereUpdatedAt($value)
 * @property boolean $backend_user_id
 * @property boolean $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereBackendUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereUserId($value)
 * @property string $backend_user_name
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Appointment whereBackendUserName($value)
 */
class Appointment extends Model
{
    protected $table = 'appointments';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
