<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6,0006
 * Time: 15:27
 */

namespace Admin\Model;


use Think\Model;

class ZushouModel extends Model
{
    protected $_validate = array(
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('name', 'require', '名称不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'currency', '价格不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('last_time', 'require', '截止时间不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT),
    );
}