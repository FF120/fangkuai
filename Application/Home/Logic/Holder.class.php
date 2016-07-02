<?php
namespace Home\Logic;

use Think\Think;
use Org\Util\Session;
final class Holder extends Think
{
    /** 获取当前用户的帐号信息（非及时更新的信息） */
    public static function getUser(){
        $holderUser = Session::get("holderUser");
        $user = $holderUser['31fff65366408155bae0c9617d541b3f'];
        return $user;
    }

    /**
     * 功能：设置当前用户的帐号信息。
     * @param array		user  当前登录用户的帐号信息。
     * @return boolean
     */
    public static function setUser($user){
        if( empty($user) || !is_array($user) ) return false;
        $holderUser = Session::get("holderUser");
        $holderUser['31fff65366408155bae0c9617d541b3f'] = $user;
        Session::set('holderUser', $holderUser);
        return true;
    }

    /** 获取当前用户的唯一身份码（token） */
    public static function getToken(){
        $holderUser = Session::get("holderUser");
        return $holderUser['31fff65366408155bae0c9617d541b3f']['token'];
    }

    /**
     * 在holder中清除登录用户，即登出
     */
    public static function removeUser(){
        Session::destroy();
    }
}
