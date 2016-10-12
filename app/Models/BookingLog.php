<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\BookingLog
 *
 * @property integer $id
 * @property boolean $booking_id
 * @property string $content
 * @property boolean $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereBookingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereUpdatedAt($value)
 * @property string $booking_code
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingLog whereBookingCode($value)
 */
class BookingLog extends Model
{
    protected $table = 'booking_logs';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
