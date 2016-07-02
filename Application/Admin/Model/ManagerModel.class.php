<?php
namespace Admin\Model;

use Think\Model;
/**
 * 管理员Model
 * @author 黄涛
 */
class ManagerModel extends Model{
    //登录检验
    public function check_login($name, $pwd) {
        $info = $this->where("mg_name='$name'")->find();
        if($info){
            if($info['password'] == $pwd){
                return $info;
            } else{
                return null;
            }
        } else{
            return false;
        }
    }
}