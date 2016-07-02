<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 大后台认证审核控制器
 * @author huangtao
 * Date: 2015/10/26
 * Time: 21:04
 */
class VerifyController extends Controller {
    /*
     * 列出用户信息
     */
    public function list_userinfo() {
        $sql = "select * from fk_user where 1=1 ";
        if(!empty($_GET)){
            if(isset($_GET['username']) && $_GET['username'] != ""){
                $sql = $sql . " and username like '%".$_GET['username']."%'";
            }
            if(isset($_GET['truename']) && $_GET['truename'] != ""){
                $sql = $sql . " and truename like '%".$_GET['truename']."%'";
            }
            if(isset($_GET['is_verified']) && $_GET['is_verified'] != ""){
                $sql = $sql . " and is_verified=".$_GET['is_verified'];
                //控制查询下拉列表框
                $this->assign("is_verified", $_GET['is_verified'] + 100);
            }
        }
        //实例化UserModel对象
        $user = new \Home\Model\UserModel();
        $countSql = "select count(*) as num from " . "(" .$sql." )a";
        
        //查询总记录数
        $total = $user->query($countSql)[0]['num'];
        
        //每页条数
        $per = 10;
        
        //实例化分页对象
        $page_obj = new \Admin\Common\Page($total, $per);
        
        //查询用户数据
        $sql = $sql ." ". $page_obj->limit;
        $userInfos = $user->query($sql);
        
        $pagelist = $page_obj->fpage();
        
        //将变量输出到模板
        $this->assign("userInfos", $userInfos);
        //分页对象输出到模板
        $this->assign('pagelist', $pagelist);
       
        //显示模板
        $this->display();
    }
    
    /*
     * 列出现货产品信息
     */
    public function list_spotinfo() {
        $sql = "select * from fk_spot_goods_record where 1=1 ";
        if(!empty($_GET)){
            if(isset($_GET['product_name']) && $_GET['product_name'] != ""){
                $sql = $sql . " and product_name like '%".$_GET['product_name']."%'";
            }
            if(isset($_GET['product_material']) && $_GET['product_material'] != ""){
                $sql = $sql . " and product_material like '%".$_GET['product_material']."%'";
            }
            if(isset($_GET['approval_status']) && $_GET['approval_status'] != ""){
                $sql = $sql . " and approval_status=".$_GET['approval_status'];
                //控制查询下拉列表框
                $this->assign("approval_status", $_GET['approval_status'] + 100);
            }
        }
        //实例化SpotGoodsRecordModel对象
        $spot = new \Admin\Model\SpotGoodsRecordModel();
        $countSql = "select count(*) as num from " . "(" .$sql." )a";
        //查询总记录数
        $total = $spot->query($countSql)[0]['num'];
        //每页条数
        $per = 10;
    
        //实例化分页对象
        $page_obj = new \Admin\Common\Page($total, $per);
        
        $sql = $sql." order by approval_status " . $page_obj->limit;
    
        //查询现货产品数据
        $spotInfos = $spot->query($sql);
    
        $pagelist = $page_obj->fpage();
    
        //将变量输出到模板
        $this->assign("spotInfos", $spotInfos);
        //分页对象输出到模板
        $this->assign('pagelist', $pagelist);
        //显示模板
        $this->display();
    }
    
    /*
     * 列出促销信息,即现货表中is_promotional为1
     */
    public function list_promotionalinfo() {
        $sql = "select * from fk_spot_goods_record where approval_status=1 and is_promotional=1 ";
        if(!empty($_GET)){
            if(isset($_GET['product_name']) && $_GET['product_name'] != ""){
                $sql = $sql . " and product_name like '%".$_GET['product_name']."%'";
            }
            if(isset($_GET['product_material']) && $_GET['product_material'] != ""){
                $sql = $sql . " and product_material like '%".$_GET['product_material']."%'";
            }
            if(isset($_GET['promotional_status']) && $_GET['promotional_status'] != ""){
                $sql = $sql . " and promotional_status=".$_GET['promotional_status'];
                //控制查询下拉列表框
                $this->assign("promotional_status", $_GET['promotional_status'] + 100);
            }
        }
        //实例化SpotGoodsRecordModel对象
        $promotional = new \Admin\Model\SpotGoodsRecordModel();
        $countSql = "select count(*) as num from " . "(" .$sql." )a";
        //查询总记录数
        $total = $promotional->query($countSql)[0]['num'];
        //每页条数
        $per = 10;
    
        //实例化分页对象
        $page_obj = new \Admin\Common\Page($total, $per);
    
        //查询促销数据
        $sql = $sql." order by promotional_status " . $page_obj->limit;
        $promotionalInfos = $promotional->query($sql);
    
        $pagelist = $page_obj->fpage();
    
        //将变量输出到模板
        $this->assign("promotionalInfos", $promotionalInfos);
        //分页对象输出到模板
        $this->assign('pagelist', $pagelist);
        //显示模板
        $this->display();
    }
    
    /*
     * 列出求购信息
     */
    public function list_goodsbuyinfo() {
        $sql = "select * from fk_goods_to_buy where 1=1 ";
        if(!empty($_GET)){
            if(isset($_GET['product_name']) && $_GET['product_name'] != ""){
                $sql = $sql . " and product_name like '%".$_GET['product_name']."%'";
            }
            if(isset($_GET['product_material']) && $_GET['product_material'] != ""){
                $sql = $sql . " and product_material like '%".$_GET['product_material']."%'";
            }
            if(isset($_GET['approval_status']) && $_GET['approval_status'] != ""){
                $sql = $sql . " and approval_status=".$_GET['approval_status'];
                //控制查询下拉列表框
                $this->assign("approval_status", $_GET['approval_status'] + 100);
            }
        }
        //实例化GoodsToBuyModel对象
        $goodsBuy = new \Admin\Model\GoodsToBuyModel();
        //查询总记录数
        $countSql = "select count(*) as num from " . "(" .$sql." )a";
        //查询总记录数
        $total = $goodsBuy->query($countSql)[0]['num'];
        //每页条数
        $per = 10;
    
        //实例化分页对象
        $page_obj = new \Admin\Common\Page($total, $per);
    
        //查询求购数据
        $sql = $sql." order by approval_status " . $page_obj->limit;
        $goodsBuyInfos = $goodsBuy->query($sql);
    
        $pagelist = $page_obj->fpage();
    
        //将变量输出到模板
        $this->assign("goodsBuyInfos", $goodsBuyInfos);
        //分页对象输出到模板
        $this->assign('pagelist', $pagelist);
        //显示模板
        $this->display();
    }
    
    
    /*
     * 审核用户
     */
    public function verify_user() {
        if(!empty($_POST)){
            //实例化User对象
            $user = new \Home\Model\UserModel();
            $user->id = $_POST['user_id'];
            $user->is_verified = 1;
            $result = $user->save();
            $this->ajaxReturn($result);
        } 
        
    }
    
    /*
     * 审核发布产品
     */
    public function verify_spot() {
        if(!empty($_POST)){
            //实例化SpotGoodsRecordModel对象
            $spot = new \Admin\Model\SpotGoodsRecordModel();
            $spot->sgr_id = $_POST['sgr_id'];
            $spot->approval_status = 1;
            $result = $spot->save();
            $this->ajaxReturn($result);
        }
    
    }
    
    /*
     * 审核发布促销
     */
    public function verify_promo() {
        if(!empty($_POST)){
            //实例化SpotGoodsRecordModel对象
            $spot = new \Admin\Model\SpotGoodsRecordModel();
            $spot->sgr_id = $_POST['sgr_id'];
            $spot->promotional_status = 1;
            $result = $spot->save();
            $this->ajaxReturn($result);
        }
    
    }
    
    /*
     * 审核发布求购
     */
    public function verify_goods_buy() {
        if(!empty($_POST)){
            //实例化GoodsQuotationModel对象
            $goodsBuy = new \Admin\Model\GoodsToBuyModel();
            $goodsBuy->gtb_id = $_POST['gtb_id'];
            $goodsBuy->approval_status = 1;
            $result = $goodsBuy->save();
            $this->ajaxReturn($result);
        }
    
    }
    
    /*
     * 查看用户详细信息
     */
    public function detail_userinfo($userid) {
        //实例化User对象
        $user = new \Home\Model\UserModel();
        $userInfo = $user->find($userid);
        
        //公司id
        $company_id = $userInfo['company_id'];
        //公司实体
        $userCompany = new \Home\Model\UserCompanyModel();
        $userCompanyInfo = $userCompany->find($company_id);
        
        $this->assign("userInfo", $userInfo);
        $this->assign("userCompanyInfo", $userCompanyInfo);
        
        $this->display();
    }
    
    /*
     * 查看现货（发布产品）信息
     */
    public function detail_spotinfo($sgr_id) {
        $model = new \Think\Model();
        //查询现货产品数据
        $sql = "select * from fk_spot_goods_record spot join fk_user user on spot.user_id=user.id where spot.sgr_id=".$sgr_id;
        $spotInfo = $model->query($sql)[0];
    
        $this->assign("spotInfo", $spotInfo);
        $this->display();
    }
    
    /*
     * 查看促销详细信息
     */
    public function detail_promoinfo($pgr_id) {
        $model = new \Think\Model();
        //查询现货产品数据
        $sql = "select * from fk_spot_goods_record spot join fk_user user on spot.user_id=user.id 
                where spot.promotional_status = 1 and spot.sgr_id=".$pgr_id;
        $promoInfo = $model->query($sql)[0];
    
        $this->assign("promoInfo", $promoInfo);
        $this->display();
    }
    
    /*
     * 查看求购详细信息
     */
    public function detail_goodsbuyinfo($gtb_id) {
        $model = new \Think\Model();
        //查询求购数据
        $sql = "select * from fk_goods_to_buy buy join fk_user user on buy.user_id=user.id where buy.gtb_id=".$gtb_id;
        $goodsBuyInfo = $model->query($sql)[0];
        
    
        $this->assign("goodsBuyInfo", $goodsBuyInfo);
        $this->display();
    }
}




