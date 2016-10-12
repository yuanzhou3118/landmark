<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\BookingStatus
 *
 * @property integer $id
 * @property boolean $booking_id
 * @property boolean $backend_user_id
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereBookingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereBackendUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereUpdatedAt($value)
 * @property boolean $booking_code
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BookingStatus whereBookingCode($value)
 */
class BookingStatus extends Model
{
    protected $table = 'booking_statuses';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
