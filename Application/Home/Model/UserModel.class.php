<?php
namespace Home\Model;

use Think\Model\RelationModel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/23
 * Time: 21:04
 */
class UserModel extends RelationModel
{
    protected $_validate = array(
        array('verify','require','验证码必须！'), //默认情况下用正则进行验证
        array('telephone','','帐号名称已经存在！',0,'unique',4), // 在登陆的时候验证手机号是否在数据库中
        array('password',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
        array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
    );
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