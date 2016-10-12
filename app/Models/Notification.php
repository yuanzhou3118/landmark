<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Notification
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $message
 * @property string $send_time
 * @property string $sent_rate
 * @property string $advanced_options
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereSendTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereSentRate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereAdvancedOptions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereUpdatedAt($value)
 * @property boolean $backend_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereBackendId($value)
 * @property string $send_rate
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereSendRate($value)
 * @property string $message_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Notification whereMessageId($value)
 */
class Notification extends Model
{
    protected $table = 'notifications';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
