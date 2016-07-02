<?php

namespace Admin\Controller;
use Think\Controller;
/**
 * 管理员控制器
 * @author huangtao
 *
 */
class ManagerController extends Controller {
    
    public function login(){
        //两个逻辑：展示、收集
        if(!empty($_POST)){
            $manager = new \Admin\Model\ManagerModel();
            
            $result = $manager->check_login($_POST['mg_name'], $_POST['password']);
            if($result){
                session_set_cookie_params(60);
                //session持久化用户信息(id/name)，页面跳转到后台
                session('admin_id', $result['mg_id']);
                session('admin_name', $result['mg_name']);
                session('last_login_time', $result['last_login_time']);
                //将最近登录时间保存到数据库
                $result['last_login_time'] = date('y-m-d H:i:s',time());
                $manager->save($result);
                
                $this->redirect('Index/index');
            } else{
                echo "用户名密码错误！";
            }
        }
        $this->display();
    }
    
    public function update_pwd() {
        if(!empty($_POST)){
            $manager = new \Admin\Model\ManagerModel();
            $managerInfo = $manager->find($_POST['mg_id']);
            if($managerInfo['password'] == $_POST['old_pwd']){
                if($_POST['new_pwd'] == $_POST['new_pwd2']){
                    $manager->mg_id = $_POST['mg_id'];
                    $manager->password = $_POST['new_pwd'];
                    $result = $manager->save();
                    if($result){
                        //$this->redirect([分组/控制器/操作方法]地址，参数， 延迟时间，提示信息);
                        $this->redirect('Index/right', array(), 2, '修改密码成功');
                    } else{
                        $this->redirect('Index/right', array(), 2, '修改密码失败');
                    }
                } else{
                    $this->assign('error', '两次密码输入不相同！');
                }
            } else{
                $this->assign('error', '原密码输入不正确！');
            }
        }
        $this->display();
    }
    
    public function logout() {
        session('admin_id', null);
        session('admin_name', null);
        
        $this->redirect('login');
    }
}