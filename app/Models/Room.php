<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Room
 *
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereUpdatedAt($value)
 * @property string $desc
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereDesc($value)
 */
class Room extends Model
{
    protected $table = 'rooms';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
