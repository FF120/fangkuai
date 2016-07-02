<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(empty(session('admin_name'))){
            $this->redirect("Manager/login");
        }
	    $this->display();
    }
    
    /* private function init(){
        $model = new \Think\Model();
        $info = $model->query("select value from fk_dict t where t.type='sys_param' and t.key='work_time'");
        $work_time = $info[0];
        //工作时间
        C("WORK_TIME", $work_time);
    } */
    
    public function top(){
        $this->display();
    }
    
    public function left(){
        $this->display();
    }
    
    public function right(){
        $this->display();
    }
    
    public function foot(){
        $this->display();
    }
    
    public function header(){
        $this->display();
    }
    
    /*
     * 设置工作时间
     */
    public function set_work_time(){
        $model = new \Think\Model();
        $work_time = $model->query("select id, value from fk_dict t where t.type='sys_param' and t.key='work_time'");
        if(!empty($_POST)){
            $dict = new \Admin\Model\DictModel();
            $dict->id = $_POST['id'];
            $dict->key = 'work_time';
            $dict->type = 'sys_param';
            $dict->value = $_POST['new_work_time'];
            $result = $dict->save();
            if($result){
                //$this->redirect([分组/控制器/操作方法]地址，参数， 延迟时间，提示信息);
                $this->redirect('Index/set_work_time', array(), 2, '设置工作时间成功');
            } else{
                $this->redirect('Index/set_work_time', array(), 2, '设置工作时间失败');
            }
        }
        $this->assign("work_time", $work_time[0]);
        $this->display();
    }
    
    public function advice_response(){
        $this->display();
    }
}



