<?php
/**
 * Created by PhpStorm.
 * User: sopzhou
 * Date: 2016/8/15
 * Time: 16:47
 */

namespace App\Traits;

use App\Models\Product;

trait ProductTrait
{
    /**
     * 根据产品id查询信息。
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    protected function getProductById($id, array $columns = ['*'])
    {
        return Product::whereId($id)->whereStatus(true)->first($columns);
    }

    protected function getProductList()
    {
        return Product::get([
            'id as product_id',
            'img_url',
            'availability',
            'available_date',
            'IsSimilarItem',
        ]);
    }

}