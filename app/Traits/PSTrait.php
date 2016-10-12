<?php
/**
 * Created by PhpStorm.
 * User: sopzhou
 * Date: 2016/8/15
 * Time: 16:47
 */

namespace App\Traits;

trait PSTrait
{
    /**
     * 发送信息。
     *
     * @param $msg
     * @param $list
     * @return int
     */
    protected function sendMsgByType($type,$msg,$list)
    {
        return 0;
    }
    /**
     * 通过user_id检索发送信息列表。
     *
     * @param $msg
     * @param $list
     * @return int
     */
    protected function getMsgByid($id)
    {
        return '暂无数据';
    }

}