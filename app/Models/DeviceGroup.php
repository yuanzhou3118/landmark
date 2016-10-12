<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\DeviceGroup
 *
 * @property integer $id
 * @property string $notification_key
 * @property string $notification_key_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceGroup whereNotificationKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceGroup whereNotificationKeyName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceGroup whereUpdatedAt($value)
 */
class DeviceGroup extends Model
{
    protected $table = 'device_groups';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
