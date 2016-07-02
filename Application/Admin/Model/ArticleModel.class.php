<?php
namespace Admin\Model;

use Think\Model;
/**
 * 文章Model
 * @author 黄涛
 */
class ArticleModel extends Model{
    //是否批验证
    protected $patchValidate = true;
    //自动验证
    protected $_validate = array(
        //title
        array('title', 'require', '标题不能为空'),
        array('title', '', '标题已经存在', 0, 'unique'),
        array('title', '1,50','标题最长为50','3','length'),
        array('content', '0,1000','内容最长为1000','3', 'length')
    );
}