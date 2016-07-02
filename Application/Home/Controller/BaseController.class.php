<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/26
 * Time: 14:46
 */

namespace Home\Controller;

use Think\Controller;
use Think\Log;
use Home\Logic\Holder;
class BaseController extends Controller
{
    final public function _initialize(){
        $this->_setAttibute();
        $this->_checkToken();
    }

    protected function _checkToken(){
        $token = Holder::getToken();
        //if( empty($token) ) $this->preUserLogin();
        if( empty($token) ) {
            header("Content-type: text/html; charset=utf-8");
            $this->redirect('User/index','',3,"登陆已超时，请重新登陆...");
        }
        if(!empty($token)){
            $user = Holder::getUser();
            $data['is_login'] = true;
            $data['telephone'] = $user['telephone'];
            $data['password'] = $user['password'];
            Log::write("从token中获取的登陆信息:".json_encode($data),Log::INFO);
            $this->assign('login_info',$data);
            unset($data);
        }
    }
    //为共用的模版变量赋值
    protected function _setAttibute(){
        $token = Holder::getToken();
        if(!empty($token)) {
            $user = Holder::getUser();
            $data['is_login'] = true;
            $data['telephone'] = $user['telephone'];
            $data['password'] = $user['password'];
            Log::write("从token中获取的登陆信息:" . json_encode($data), Log::INFO);
            $this->assign('login_info', $data);
            unset($data);
        }
    }

    /* 获取用户请求的操作方法 */
    final protected function getMethodName(){
        return ACTION_NAME;
    }

    //默认被执行的操作
    public function index(){
        redirect('/', 1, '您访问的页面不存在，请求将被重定向到首页！');
    }


    /* 空操作（系统在找不到指定的操作方法时会定位到空操作） */
    public function _empty(){
        redirect('/', 1, '您访问的页面不存在，请求将被重定向到首页！');
    }
}