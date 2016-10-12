<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\WishList
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $mobile_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WishList whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WishList whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WishList whereMobileUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WishList whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WishList whereUpdatedAt($value)
 */
class WishList extends Model
{
    protected $table = 'wish_lists';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
