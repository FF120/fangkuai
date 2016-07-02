<?php
namespace Admin\Model;

use Think\Model;
/**
 * 广告Model
 * @author 黄涛
 */
class AdvertModel extends Model{
    //是否批验证
    protected $patchValidate = true;
    //自动验证
    protected $_validate = array(
        //title
        array('title', 'require', '标题不能为空'),
        array('title', '', '标题已经存在', 0, 'unique'),
        array('title', '1,50','标题最长为50','3', 'length'),
        array('desc', '0,200','描述最长为200','3', 'length')
    );
}