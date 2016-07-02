<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 广告控制器类
 * @author 黄涛
 *
 */
class AdvertController extends Controller {
    //应用绝对对径，如"c:\xampp\..."
    public static $app_absolute_path = "";
    
    public function __construct(){
        parent::__construct();
        //为静态变量赋值
        AdvertController::$app_absolute_path = dirname(dirname(dirname(dirname(__FILE__))));
    }
    
    public function index(){
    	$this->display();
    }
    
    
    
    public function add_advert() {
        if(!empty($_POST)){
            //实例化广告Model
            $advert = new \Admin\Model\AdvertModel();
            /*
             * 处理上传的图片
             */
            if($_FILES['advert_img']['error'] < 4){
                //处理图片
                $this->deal_img();
                //校验且收集表单数据
                $datas = $advert->create();
                if($datas){
                    $result = $advert->add($datas);
                    if($result){
                        //$this->redirect([分组/控制器/操作方法]地址，参数， 延迟时间，提示信息);
                        $this->redirect('list_advert', array(), 2, '添加广告成功');
                    } else{
                        $this->redirect('list_advert', array(), 2, '添加广告失败');
                    }
                } else{
                    $this->assign('errorInfo', $advert->getError());
                    $this->display();
                }
            } else{
                $this->assign("fileError", "上传文件为空！");
                $this->display();
            }
        } else{
            $this->display();
        }
    }
    
    /**
     * 修改广告
     * @param $advert_id 广告id
     */
    public function update_advert($advert_id) {
        if(!empty($_POST)){
            //实例化广告Model
            $advert = new \Admin\Model\AdvertModel();
            /*
             * 处理上传的图片
            */
            if($_FILES['advert_img']['error'] < 4){
                /*
                 * 因为有图片的存在，所以修改前必须将原图片路径
                 * 从数据库取出保存到一个变量中,然后修改数据，最后再把原图片删除
                 */
                //旧的大图路径
                $old_org_img_path = $advert->find($_POST['id'])['org_img_path'];
                //旧的缩略图路径
                $old_small_img_path = $advert->find($_POST['id'])['small_img_path'];
                
                //处理将上传的图片
                $update_result = $this->deal_img();
                //处理文件错误
                if($update_result){
                    //将错误信息返回到页面
                    $this->assign("fileError", $update_result);
                    //将页面已输入数据返回
                    $this->assign("advert_info", $advert->create());
                    $this->display();
                } else {
                    //校验且收集表单数据
                    $datas = $advert->create();
                    $result = $advert->save($datas);
                    
                    if($result){
                        //删除原图片
                        unlink(AdvertController::$app_absolute_path . "/".$old_org_img_path);
                        unlink(AdvertController::$app_absolute_path . "/".$old_small_img_path);
                        //$this->redirect([分组/控制器/操作方法]地址，参数， 延迟时间，提示信息);
                        $this->redirect('list_advert', array(), 2, '修改广告成功');
                    } else{
                        $this->redirect('update_advert', $datas, 2, '修改广告失败');
                    }
                }
            }else {//$_FILES['advert_img']['error'] < 4即图片为空，则只修改其他数据
                //校验且收集表单数据
                $datas = $advert->create();
                $result = $advert->save($datas);
                
                if($result){
                    $this->redirect('list_advert', array(), 2, '修改广告成功');
                } else{
                    $this->redirect('update_advert', $datas, 2, '修改广告失败');
                }
            }
        }else {//如果$_POST为空，则为跳转到修改页面
            //实例化广告Model
            $advert = new \Admin\Model\AdvertModel();
            //根据广告id查询出广告信息
            $advertInfo = $advert->find($advert_id);
        
            $this->assign("advertInfo", $advertInfo);
            $this->display();
        }
    }
    
    /**
     * 删除广告
     * @param $advert_id 广告id
     */
    public function delete_advert() {
        if(!empty($_POST)){
            //实例化广告Model
            $advert = new \Admin\Model\AdvertModel();
            $advert_id = $_POST['advert_id'];
            //根据广告id查询出广告信息
            $advertInfo = $advert->find($advert_id);
            
            //大图路径
            $org_img_path = $advert->find($_POST['id'])['org_img_path'];
            //缩略图路径
            $small_img_path = $advert->find($_POST['id'])['small_img_path'];
            
            $result = $advert->delete($advert_id);
            if($result){
                //删除原图片
                unlink(AdvertController::$app_absolute_path . "/".$org_img_path);
                unlink(AdvertController::$app_absolute_path . "/".$small_img_path);
            
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn(0);
            }
        }
    }
    
    /*
     * 处理上传图片
     */
    private function deal_img(){
        //文件保存根路径
        $img_root_path = './Public/Uploads/advert_imgs/';
        //上传附件类型
        $img_exts = array('jpg', 'gif', 'png', 'jpeg');
        
        $cfg = array(
            'rootPath' => $img_root_path,//保存的根路径
            'exts' => $img_exts,//上传附件类型
        );
        $up = new \Think\Upload($cfg);
        //uploadOne()方法执行成功后会把附件（在服务器）的名字和路径等相关信息返回给我们
        $z = $up->uploadOne($_FILES['advert_img']);
    
        if(!$z){
            return $up->getError();
        }
    
        //把原附件路径存储到数据库中
        $org_img_path = $up->rootPath.$z['savepath'].$z['savename'];
    
        /*
         * 生成缩略图，并把路径保存到数据库
        */
        //缩略图文件名（包含路径）
        $small_img_path = $up->rootPath.$z['savepath'].'small_'.$z['savename'];
        //制作缩略图
        $im = new \Think\Image();
        $im->open($org_img_path);
        $im->thumb(100, 100);
        $im->save($small_img_path);
    
        $_POST['org_img_path'] = ltrim($org_img_path, "./");
        $_POST['small_img_path'] = ltrim($small_img_path, "./");
        $_POST['create_time'] = date('y-m-d H:i:s', time());
    }
    
    /*
     * 广告信息列表
     */
    public function list_advert() {
        $sql = "select * from fk_advert where 1=1 ";
        if(!empty($_GET)){
            if(isset($_GET['title']) && $_GET['title'] != ""){
                $sql = $sql . " and title like '%".$_GET['title']."%'";
            }
            if(isset($_GET['position']) && $_GET['position'] != ""){
                $sql = $sql . " and position=".$_GET['position'];
                //控制查询下拉列表框
                $this->assign("position", $_GET['position'] + 100);
            }
            if(isset($_GET['is_used']) && $_GET['is_used'] != ""){
                $sql = $sql . " and is_used=".$_GET['is_used'];
                //控制查询下拉列表框
                $this->assign("is_used", $_GET['is_used'] + 100);
            }
        }
        //实例化广告Model
        $advert = new \Admin\Model\AdvertModel();
        $countSql = "select count(*) as num from " . "(" .$sql." )a";
        //查询总记录数
        $total = $advert->query($countSql)[0]['num'];
        //每页条数
        $per = 10;
    
        //实例化分页对象
        $page_obj = new \Admin\Common\Page($total, $per);
    
        //查询现货产品数据
        $sql = $sql." order by create_time desc " . $page_obj->limit;
        $advertInfos = $advert->query($sql);
    
        $pagelist = $page_obj->fpage();
    
        //将变量输出到模板
        $this->assign("advertInfos", $advertInfos);
        //分页对象输出到模板
        $this->assign('pagelist', $pagelist);
        //显示模板
        $this->display();
    }
    
    /*
     * 处理是否启用，如果传来的参数是未启用，则变为启用；反之亦然
     */
    public function deal_is_used() {
        if(!empty($_POST)){
            //实例化User对象
            $advert = new \Admin\Model\AdvertModel();
            //处理参数
            $advert->id = $_POST['id'];
            if($_POST['is_used'] == 0){
                $advert->is_used = 1;
            } else if($_POST['is_used'] == 1){
                $advert->is_used = 0;
            }
            //修改状态
            $result = $advert->save();
            //返回结果
            $this->ajaxReturn($result);
        };
    }
    
    
}















