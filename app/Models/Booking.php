<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Booking
 *
 * @property integer $id
 * @property string $booking_code
 * @property integer $mobile_user_id
 * @property string $restaurant_name
 * @property string $special_req
 * @property integer $restaurant_id
 * @property boolean $booking_type
 * @property boolean $adult
 * @property boolean $children
 * @property string $time
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereBookingCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereMobileUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereRestaurantName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereSpecialReq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereRestaurantId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereBookingType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereAdult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereChildren($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereUpdatedAt($value)
 * @property string $customer_firstname
 * @property string $customer_lastname
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereCustomerFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Booking whereCustomerLastname($value)
 */
class Booking extends Model
{
    protected $table = 'bookings';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
