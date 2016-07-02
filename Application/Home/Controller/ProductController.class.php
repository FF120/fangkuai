<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/21
 * Time: 23:17
 */

namespace Home\Controller;
use Think\Controller;
use Think\Page;
use Home\Logic\Holder;
class ProductController extends BaseController
{
    public function _checkToken(){
        parent::_setAttibute();
        switch( $this->getMethodName() ){
            case 'index':break;
            case 'shopping':break;
            case 'cai_gou_bao_jia':break;
            case 'cu_xiao':break;
            case 'gang_chang':break;
            case 'buxiugang':break;
            default:parent::_checkToken();
        }
    }
    public function index(){
        //获取公告信息
        $m_news = M('news');
        $news = $m_news->order("created_at desc")->limit(3)->select();
		
        //获取产品信息
        $d_sgr = D('spot_goods_record');
		$condition["is_listed"]=1;
		$condition["approval_status"]=array("neq",0);//不等于0 表示审核通过
        $products = $d_sgr->where($condition)->order("created_at desc")->limit(10)->select();
		
        //获取订单信息
        //$orders = D('order');
        //$orders = $orders->Relation(true)->limit(16)->select();
        $this->assign('news',$news);
        $this->assign('products',$products);
        //$this->assign('orders',$orders);
        $tpl = "Index:index";
        $this->display($tpl);
    }
	public function shopping(){
		$d_spot_goods_record = D('spot_goods_record');
		$condition["is_listed"]=1;
		$condition["approval_status"]=array("neq",0);//不等于0 表示审核通过 
        $count = $d_spot_goods_record->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        $result = $d_spot_goods_record->where($condition)->order("created_at desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('products',$result);
        $this->assign('page',$show);
       
        $tpl="Product:shopping_buxiugang";
        $this->display($tpl);
	}
    public function bandai(){
        $product_type = I('product_type');
        $tpl="Product:shopping_buxiugang";
        $this->display($tpl);
    }

    public function buxiugang(){
        $d_spot_goods_record = D('spot_goods_record');
		$condition["is_listed"]=1;
		$condition["approval_status"]=array("neq",0);//不等于0 表示审核通过 
        $count = $d_spot_goods_record->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        $result = $d_spot_goods_record->where($condition)->order("created_at desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('products',$result);
        $this->assign('page',$show);
       
        $tpl="Product:shopping_buxiugang";
        $this->display($tpl);
    }
    public function wufengguan(){
        $product_type = I('product_type');
        $tpl="Product:shopping_buxiugang";
        $this->display($tpl);
    }
    public function youtegang(){
        $product_type = I('product_type');
        $tpl="Product:shopping_buxiugang";
        $this->display($tpl);
    }
 
    public function youxian(){
        $product_type = I('product_type');
        $tpl="Product:shopping_buxiugang";
        $this->display($tpl);
    }

    public function cai_gou_bao_jia(){
        
		$d_goods_to_buy=D("goods_to_buy");
		
		$condition["approval_status"]=array("neq","0");
		$count=$d_goods_to_buy->where($condition)->count();
		$Page = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
    
		$result=$d_goods_to_buy->where($condition)->relation("company")->order("created_at desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign("page",$show);
		$this->assign("goods",$result);
		
		
        $tpl="Product:cai_gou_bao_jia";
		
		
        $this->display($tpl);
    }

    public function cu_xiao(){
        $product_type = I('product_type');
        $tpl="Product:cu_xiao";
		
        $d_spot_goods_record = D('spot_goods_record');
        
        $count = $d_spot_goods_record->where("is_promotional=1 and promotional_status=1")->count();// 查询满足要求的总记录数
        $Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        $products = $d_spot_goods_record->where("is_promotional=1 and promotional_status=1")->order("unit_price")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('products',$products);
        $this->assign('page',$show);
        $this->display($tpl);
    }

    public function gang_chang(){
        $product_type = I('product_type');
        $tpl="Product:gang_chang";
        $this->display($tpl);
    }
     
      
	public function  getGoodsQuotationInfo(){
		
		$user_info=Holder::getUser();
		
		$record["gtb_id"]=$_POST["gtb_id"];	
		$record["unit_price"]=$_POST["unit_price"];
		$record["is_tax_inclusive"]=$_POST["is_tax_inclusive"];
		$record["shipping_fee"]=$_POST["shipping_fee"];
		$shipping_fee_option=$_POST["shipping_fee_option"];
		$invoice_option=$_POST["invoice_option"];
		$record["user_id"]=$user_info["id"];
		$record["created_at"]=time();
	
		if($invoice_option=="1"){
		 $record["invoice_option"]="1";	
		}
		else{
		 $record["invoice_option"]="0";
		}
		
		if($shipping_fee_option=="1"){
		  $record["is_shipping_fee_inclusive"]=0;	
		}
		else{
			$record["is_shipping_fee_inclusive"]=1;
		}
		$record["delivery_place"]=$_POST["delivery_place"];
		
		$record["remark"]=$_POST["remark"];
		
	
		
		if(intval($record["user_id"])<=0||empty($record["gtb_id"])){
			$this->display("Public:error");	
		}
		
		$m_goods_quotation=M("goods_quotation");
		$res=$m_goods_quotation->add($record);
		if($res){
		  	$this->success("提交成功,请等待审核！",U("Product/cai_gou_bao_jia"));
		}
		else{
			$this->success("提交失败！请与网站管理员联系",U("Product/cai_gou_bao_jia"));
		}
	
	}

    public function create_order(){
        $product_id = I('product_id');
        //检查是否登陆，如果没有登陆，转到登陆界面

        //登陆了，获取用户信息

        //下订单，在order表中插入一条记录
        dump($product_id."订单生成成功！");
    }
   //批量添加向购物车添加订单
    public function addToCart_batch(){
    	
        $ids = I('post.ids');
		
		$sgr_ids = explode(',',$ids);

		if(count($sgr_ids)<=0){
			$this->error("您没有向购物列表添加任何商品",U("Product/shopping"));
			return 0;
		}
	    $user_info=Holder::getUser();

	    $m_order=M("order");
		$m_sgr=M("spot_goods_record");
        $m_order->startTrans();
		$order_record["created_at"]=time();
		$i=0;//循环体外用到 提前声明
		for($i=0;$i<count($sgr_ids);++$i){
		  $goodsinfo= $m_sgr->where("sgr_id=".$sgr_ids[$i])->find();
		  $order_record["sgr_id"]=$sgr_ids[$i];
		  $order_record["user_id"]=$user_info["id"];;
		  $order_record["order_seller"]=$goodsinfo["user_id"];
		  
		  $res=$m_order->add($order_record);
		 if(!$res){
		 	break;
		  } 
		}
	
		if($i<count($sgr_ids)){
			$m_order->rollback();
			$this->error("提交失败，请与网站管理员联系",U("Product/shopping"));
		}
		else{
			$m_order->commit();
			$this->error("提交成功，正在前往购物车",U("Admin/my_shopping_cart"));	
		}
	
	
		
	
        //dump($sgr_ids);
        
    }
}