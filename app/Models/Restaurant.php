<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Restaurant
 *
 * @property integer $id
 * @property integer $orig_id
 * @property string $name
 * @property string $image_a
 * @property string $image_b
 * @property string $image_c
 * @property string $image_d
 * @property string $image_e
 * @property string $title
 * @property string $en-description
 * @property string $sc-description
 * @property string $tc-description
 * @property string $logo_url
 * @property string $tag
 * @property string $open_hours
 * @property string $booking_hours
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $location
 * @property boolean $booking_type
 * @property string $restaurant_url
 * @property boolean $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereOrigId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereImageA($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereImageB($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereImageC($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereImageD($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereImageE($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereEnDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereScDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereTcDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereLogoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereTag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereOpenHours($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereBookingHours($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereContactName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereContactPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereBookingType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereRestaurantUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereUpdatedAt($value)
 * @property string $en_description
 * @property string $sc_description
 * @property string $tc_description
 * @property string $image_url
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereImageUrl($value)
 * @property string $en_title
 * @property string $sc_title
 * @property string $tc_title
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereEnTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereScTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Restaurant whereTcTitle($value)
 */
class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
