<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/21
 * Time: 21:06
 */

namespace Home\Controller;
use Think\Controller;
use Home\Logic\UserLogic;
use Home\Logic\Holder;
use Think\Log;

class UserController extends BaseController
{
    public function _checkToken(){
        parent::_setAttibute();
        switch( $this->getMethodName() ){
            case 'index':break;
            case 'register':break;
            case 'register2':break;
            case 'register3':break;
            case 'login':break;
            case 'logout':break;
            case 'verify':break;
            case 'test':break;
            case 'send_sms':break;
            default:parent::_checkToken();
        }
    }
    //显示登陆界面
    public function index(){
        $token = Holder::getToken();
        if($token) {
            $this->error('不能重复登陆！');
        }
        /////////iiiiiiiiiiii
        $tpl="User:login_0";
        $this->display($tpl);
    }
    //执行登陆操作
    public function login(){
        $telephone = I('post.telephone');
        $password = I('post.password');
        $auto_login = I('post.auto_login');
        if((!isset($telephone))||empty($telephone)){
            $this->error('用户名不能为空！');
        }else if((!isset($password))||empty($password)){
            $this->error('密码不能为空！');
        }else{
            if (IS_POST) {
                // 实例化Login对象
                $login = D('user');
                // 组合查询条件
                $where = array();
                $where['telephone'] = $telephone;
                $result = $login->where($where)->field('id,telephone,password,token,last_time')->find();
                // 验证用户名 对比 密码
                if ($result && $password == $result['password']) {
                    // 存储session
                    session('user_id', $result['id']);          // 当前用户id
                    session('telephone', $result['telephone']);   // 当前用户名
                    session('last_time', $result['last_time']);   // 上一次登录时间
                    $result['token']= md5($result['telephone'].$result['password'].$result['last_time']);
                    $session['token'] = $result['token'];
                    $a = Holder::setUser($result);
                    // 更新用户登录信息
                    $where['id'] = session('user_id');
                    unset($data);
                    $data['last_time'] = date('Y-m-d h:i:s',time());
                    $data['token'] = $result['token'];
                    M('users')->where($where)->save($data);
                    $this->success('登录成功,正跳转至系统首页...', U('Product/index'));
                } else {
                    $this->error('登录失败,用户名或密码不正确!');
                }
            } else {
                $this->display('User:login_0');
            }
        }
    }
    //注册界面1
    public function register(){
        $tpl = "User:login_1";
        $this->display($tpl);
    }
    //注册界面2
    public function register2(){
        $telephone = I('post.telephone');
        $yanzhengma = I('post.yanzhengma');
        $sms_code = I('post.message');

        $sms = M('sms');
        $condition['sms_phone'] = $telephone;
        $messege = $sms->where($condition)->order("created_at desc")->select();
        if(!empty($messege)){
            $s = $messege[0];
            $code = $s['sms_code'];
            $status = $s['status'];
            $time = $s['created_at'];
            if($status == 1 && $code == $sms_code) {
                $data['status'] = 2;
                $sms->where($condition)->save($data);
                $tpl = "User:login_2";
                $this->assign("telephone",$telephone);
                $this->display($tpl);
            }else{
                $this->error("手机验证码错误！");
            }
        }else {
            $this->error("手机验证码错误！");
        }
    }
    //注册界面3
    public function register3(){
        $telephone = I('post.telephone');
        $password = I('post.password');
        $truename = I('post.truename');
        $company_name = I('post.company_name');
        if((!isset($telephone))||empty($telephone)){
            $this->error("手机号不能为空！");
        }else if(!isset($password)||empty($password)){
            $this->error("密码不能为空！");
        }else if(!isset($truename)||empty($truename)){
            $this->error("真实姓名不能为空！");
        }else if(!isset($company_name)||empty($company_name)){
            $this->error("公司名称不能为空！");
        }else{
            $data['username'] = $truename;
            $data['telephone'] = $telephone;
            $data['password'] = $password;
            $data['truename'] = $truename;
            $data['company_name'] = $company_name;
            // 判断提交方式 做不同处理
            if (IS_POST) {
                // 实例化User对象
                $user = M('user');
                $condition['telephone'] = $telephone;
                $result = $user->where($condition)->select();
                if(empty($result)){
                    $id = $user->add($data);
                    if($id){
                        $tpl = "User:login_3";
                        $this->assign('reg_info',$data);
                        $this->display($tpl);
                    }else{
                        $this->error("注册失败");
                    }
                }else{
                    $this->error("该手机号已经被注册！");
                }
            } else {
                $this->error("必须使用POST方式提交！");
            }
        }
    }
    //登出系统
    public function logout()
    {
        // 清楚所有session
        Holder::removeUser();
        header("Content-type: text/html; charset=utf-8");
        $this->redirect('User/index', '',2, '正在退出登录...');
    }
    //发送短信验证码
    public function send_sms(){
        $telephone = I("telephone");
        $code = I('code');
        if(empty($telephone)){
            echo -1;
        }
        if(empty($code)){
            echo -2;
        }
        if($this->verify_code($code)){
            $sms_code = rand(100000,999999);
            $re = UserLogic::sendTemplateSMS("$telephone",array($sms_code,'5'),"1");//手机号码，替换内容数组，模板ID
            Log::write("AAADDD:".$re,Log::INFO);
            if($re>0){
                $sms = M('sms');
                $data['sms_phone'] = $telephone;
                $data['sms_code'] = $sms_code;
                $data['status'] = '1';//1表示还没有验证，刚刚生成
                $data['created_at'] = date('Y-m-d h:i:s',time());
                $result = $sms->add($data);
                echo  $result;
            }else{
                echo -3;//验证码发送失败
            }
        }else{
            echo 0;
        }
    }
    //生成验证码
    public function verify()
    {
        // 实例化Verify对象
        $verify = new \Think\Verify();
        // 配置验证码参数
        $verify->fontSize = 14;     // 验证码字体大小
        $verify->length = 4;        // 验证码位数
        $verify->imageH = 40;       // 验证码高度
        $verify->useImgBg = false;   // 开启验证码背景
        $verify->useNoise = false;  // 关闭验证码干扰杂点
        $verify->entry();
    }
    //验证验证码是否正确
    private function verify_code($code){
        $verify = new \Think\Verify();
        $result = $verify->check($code, '');
        return $result;
    }
    public function test(){

    }
}