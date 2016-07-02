<?php
namespace Home\Model;

use Think\Model\RelationModel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/23
 * Time: 21:04
 */
class CartModel extends RelationModel{
      protected $_link = array(
        //产品来自的钢厂名称
        'goods' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'spot_goods_record',
            'foreign_key' => 'sgr_id'
        )
    );
}