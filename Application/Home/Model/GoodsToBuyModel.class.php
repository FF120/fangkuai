<?php
namespace Home\Model;

use Think\Model\RelationModel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/23
 * Time: 21:04
 */
class GoodsToBuyModel extends RelationModel
{
  protected $_link = array(
        'quotations' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name' => 'goods_quotation',
            'foreign_key' => 'gtb_id'
        ),
        'company' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'user_company',
            'foreign_key' => 'user_id',
            "mapping_fields"=>'company_name,company_city'
        )
    );
}