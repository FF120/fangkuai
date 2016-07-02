<?php
namespace Home\Model;

use Think\Model\RelationModel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/23
 * Time: 21:04
 */
class OrderModel extends RelationModel
{
    protected $_link = array(
        //订单中的用户姓名
        'username' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'user',
            'foreign_key' => 'order_buyer',
            'as_fields' => 'username',
        ),
        'goods'=>array(
              'mapping_type' => self::BELONGS_TO,
              'class_name' => 'spot_goods_record',
              'foreign_key' => 'sgr_id',
		),//关联购买方公司
		'buyer_company'=>array(
              'mapping_type' => self::BELONGS_TO,
              'class_name' => 'user_company',
              'foreign_key' => 'user_id',
		),//关联卖方公司
		'seller_company'=>array(
              'mapping_type' => self::BELONGS_TO,
              'class_name' => 'user_company',
              'foreign_key' => 'order_seller',
		)
    );
}