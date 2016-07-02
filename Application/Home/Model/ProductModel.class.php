<?php
namespace Home\Model;

use Think\Model\RelationModel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/23
 * Time: 21:04
 */
class ProductModel extends RelationModel
{
    protected $_link = array(
        //产品来自的钢厂名称
        'factory_name' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'factory',
            'foreign_key' => 'product_factory_id',
            'as_fields' => 'factory_name,factory_city',
        ),
        'storehouse_name' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'storehouse',
            'foreign_key' => 'product_storehouse_id',
            'as_fields' => 'storehouse_name',
        ),
    );
}