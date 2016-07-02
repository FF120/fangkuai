<?php

namespace Home\Controller;
use Think\Controller;
use Think\Page;
use Home\Logic\Holder;
class AdminController extends BaseController
{
     
       //下载模版
       public function down_goods_template(){
            $file_dir = WEB_PATH."Public/templates/";
            $name="template_goods.xls";
           if (!file_exists($file_dir.$name)){
               header("Content-type: text/html; charset=utf-8");
               echo "File not found!";
               exit;
           } else {
               $file = fopen($file_dir.$name,"r");
               Header("Content-type: application/octet-stream");
               Header("Accept-Ranges: bytes");
               Header("Accept-Length: ".filesize($file_dir . $name));
               Header("Content-Disposition: attachment; filename=".$name);
               echo fread($file, filesize($file_dir.$name));
               fclose($file);
           }
       }
    public function down_qiugou_template(){
        $file_dir = WEB_PATH."Public/templates/";
        $name="template_qiugou.xls";
        if (!file_exists($file_dir.$name)){
            header("Content-type: text/html; charset=utf-8");
            echo "File not found!";
            exit;
        } else {
            $file = fopen($file_dir.$name,"r");
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: ".filesize($file_dir . $name));
            Header("Content-Disposition: attachment; filename=".$name);
            echo fread($file, filesize($file_dir.$name));
            fclose($file);
        }
    }
        //显示上传资源单页面
        public function upload_ziyuandan(){
            $tpl = "Admin:upLoad_ziyuandan";
            $this->display($tpl);
        }
		
		public function upload_qiugou(){
            $tpl = "Admin:upLoad_qiugou";
            $this->display($tpl);
        }
		
        //上传文件处理
        public function upload_file(){
            $config = array(
                'maxSize'    =>    3145728,
                'rootPath'   =>    "./Public/Uploads/",
                'savePath'   =>    './',
                'exts'       =>    array('xls','xlsx'),
                'autoSub'    =>    false,
                'saveName'  =>      'time',
                'driver'     =>    'Local'
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['upLoadFile']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $name = $info['name'];//原来的文件名
                $savename = $info['savename'];//保存在服务器的文件名称
                $savepath = $info['savepath'];
                $md5 = $info['md5'];
                $this->redirect('Admin/fabu_goods2',array('savename'=>$savename),3,'上传成功！');
            }
        }
    //上传资源单完成跳转到这里
    public function fabu_goods2()
    {
        $filename = I('get.savename');
        $file = WEB_PATH . "Public/Uploads/" . $filename;
        vendor("PHPEXCEL/PHPExcel");
        vendor("PHPEXCEL/PHPExcel/IOFactory");
        $excel = new \PHPExcel();
        date_default_timezone_set('Asia/ShangHai');
        if (!file_exists($file)) {
            exit("not found 31excel5.xls.\n");
        }
        $reader = \PHPExcel_IOFactory::createReader('Excel5');
        $PHPExcel = $reader->load($file); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一个工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数

        $highestColumm = $sheet->getHighestColumn(); // 取得总列数

        $d_sgr = D("spot_goods_record");
        $user_info = Holder::getUser();
        $record["user_id"] = $user_info["id"];
        $record["created_at"] = time();

        /** 循环读取每个单元格的数据 */

        for ($row = 2; $row <= $highestRow; $row++) {//行数是以第2行开始
            $record["product_name"] = $sheet->getCell("A" . $row)->getValue();
            $record["product_material"] = $sheet->getCell("B" . $row)->getValue();
            $record["product_specifications"] = $sheet->getCell("C" . $row)->getValue();
            $record["product_width"] = $sheet->getCell("D" . $row)->getValue();
            $record["product_length"] = $sheet->getCell("E" . $row)->getValue();
            $record["manufacturer"] = $sheet->getCell("F" . $row)->getValue();
            $record["delivery_place"] = $sheet->getCell("G" . $row)->getValue();
            $record["storehouse_name"] = $sheet->getCell("H" . $row)->getValue();
            $record["unit_price"] = $sheet->getCell("I" . $row)->getValue();
            $record["weight"] = $sheet->getCell("J" . $row)->getValue();
            $record["weighing_type"] = $sheet->getCell("K" . $row)->getValue();
            $record["remark"] = $sheet->getCell("K" . $row)->getValue();
            $res = $d_sgr->add($record);
            if (!$res) {
                break;
            }

            for ($row = 2; $row <= $highestRow; $row++) {//行数是以第2行开始
                $record["product_name"] = $sheet->getCell("A" . $row)->getValue();
                $record["product_material"] = $sheet->getCell("B" . $row)->getValue();
                $record["product_specifications"] = $sheet->getCell("C" . $row)->getValue();
                $record["product_width"] = $sheet->getCell("D" . $row)->getValue();
                $record["product_length"] = $sheet->getCell("E" . $row)->getValue();
                $record["manufacturer"] = $sheet->getCell("F" . $row)->getValue();
                $record["delivery_place"] = $sheet->getCell("G" . $row)->getValue();
                $record["storehouse_name"] = $sheet->getCell("H" . $row)->getValue();
                $record["unit_price"] = $sheet->getCell("I" . $row)->getValue();
                $record["weight"] = $sheet->getCell("J" . $row)->getValue();
                $record["weighing_type"] = $sheet->getCell("K" . $row)->getValue();
                $record["remark"] = $sheet->getCell("K" . $row)->getValue();
                $res = $d_sgr->add($record);
                if (!$res) {
                    break;
                }
            }
            if (!$res) {
            	$this->error("上传失败 ", U("Admin/fabu_goods"));
            } else {
                $this->success("发布成功，请等待审核", U("Admin/fabu_goods"));
            }
        }
    }


   //上传求购文件处理
    public function upload_qiugou_goods_file(){
        $config = array(
            'maxSize'    =>    3145728,
            'rootPath'   =>    "./Public/Uploads/",
            'savePath'   =>    './',
            'exts'       =>    array('xls','xlsx'),
            'autoSub'    =>    false,
            'saveName'  =>      'time',
            'driver'     =>    'Local'
        );
        $upload = new \Think\Upload($config);// 实例化上传类
            // 上传文件
        $info   =   $upload->uploadOne($_FILES['upLoadFile']);
		
		
        if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $name = $info['name'];//原来的文件名
                $savename = $info['savename'];//保存在服务器的文件名称
                $savepath = $info['savepath'];
                $md5 = $info['md5'];
                $this->redirect('Admin/fabu_qiugou_goods',array('savename'=>$savename),3,'上传成功！');
        }
    }

     // 读取并处理求购xls文件
    public function fabu_qiugou_goods(){
        $filename = I('get.savename');
        $file = WEB_PATH."Public/Uploads/".$filename;
        vendor("PHPEXCEL/PHPExcel");
        vendor("PHPEXCEL/PHPExcel/IOFactory");
        $excel = new \PHPExcel();
        date_default_timezone_set('Asia/ShangHai');
        if (!file_exists($file)) {
            exit("not found 31excel5.xls.\n");
        }
        $reader = \PHPExcel_IOFactory::createReader('Excel5'); 
        $PHPExcel = $reader->load($file); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一个工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
   
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数
        
        $d_gtb=D("goods_to_buy");
        $user_info=Holder::getUser();
        
		$record["user_id"]=$user_info["id"];
        $record["created_at"]=time();
		
        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++){//行数是以第2行开始
        
            $record["product_name"]=$sheet->getCell("A".$row)->getValue();
            $record["product_material"]=$sheet->getCell("B".$row)->getValue();
			$record["product_specifications"]=$sheet->getCell("C".$row)->getValue();
			$record["quantity"]=$sheet->getCell("D".$row)->getValue();
			$record["manufacturer"]=$sheet->getCell("E".$row)->getValue();
			$record["delivery_place"]=$sheet->getCell("F".$row)->getValue();
			$record["price_conditions"]=$sheet->getCell("G".$row)->getValue();
			$record["linkman"]=$sheet->getCell("H".$row)->getValue();
			$record["title"]=$sheet->getCell("I".$row)->getValue();
			$record["telephone"]=$sheet->getCell("J".$row)->getValue();
	        $res=$d_gtb->add($record);
			if(!$res){
				break;	
			}
        }
		if($res){
				$this->success("上传成功 请等待审核",U("Admin/fabu_order"));
		}
		else{
				$this->error("上传失败 ",U("Admin/fabu_order"));
		}
    
    }

   //下载现货记录
    public function download_goods_xls()
    {
    	$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
    
		$condition["is_promotional"]=0;
		
        $file = "goods.xls";
        vendor("PHPEXCEL/PHPExcel");
        vendor("PHPEXCEL/PHPExcel/IOFactory");
        $d_spot_goods_record = D('spot_goods_record');
        $data = $d_spot_goods_record->where($condition)->select();
        $objPHPExcel = new \PHPExcel();
        /*以下是一些设置 ，什么作者  标题啊之类的*/
        $objPHPExcel->getProperties()->setCreator("转弯的阳光")
            ->setLastModifiedBy("转弯的阳光")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("备份数据")
            ->setKeywords("excel")
            ->setCategory("result file");
            //设置标题
            //品名材质规格宽长厂家地区仓库计重方式价格重量
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . 1, '品名')
                        ->setCellValue('B' . 1, '材质')
                        ->setCellValue('C' . 1, '规格')
                        ->setCellValue('D' . 1, '宽')
                        ->setCellValue('E' . 1, '长')
                        ->setCellValue('F' . 1, '厂家')
                        ->setCellValue('G' . 1, '地区')
                        ->setCellValue('H' . 1, '仓库')
                        ->setCellValue('I' . 1, '价格（元/吨）')
                        ->setCellValue('G' . 1, '重量（吨）')
                        ->setCellValue('K' . 1, '计重方式')
                        ->setCellValue('L' . 1, '备注');
            foreach ($data as $k => $v) {
                $num = $k + 2;
                $objPHPExcel->setActiveSheetIndex(0)
                    //Excel的第A列，uid是你查出数组的键值，下面以此类推
                    ->setCellValue('A' . $num, $v['product_name'])
					->setCellValue('B' . $num, $v['product_material'])
					->setCellValue('C' . $num, $v['product_specifications'])
					->setCellValue('D' . $num, $v['product_width'])
					->setCellValue('E' . $num, $v['product_length'])
					->setCellValue('E' . $num, $v['product_length'])
					->setCellValue('F' . $num, $v['product_factory_id'])
                    ->setCellValue('G' . $num, $v['product_storehouse_id'])
					->setCellValue('H' . $num, $v['product_price'])
					->setCellValue('I' . $num, $v['product_quantity'])
					->setCellValue('J' . $num, $v['product_length'])
                    ->setCellValue('K' . $num, $v['product_remark']);
                
            }

        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
		$this->display("Admin:fabu_goods");
    } 


    public function download_qiugou_xls()
    {
    	
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
	
        $file = "qiugou.xls";
        vendor("PHPEXCEL/PHPExcel");
        vendor("PHPEXCEL/PHPExcel/IOFactory");
        $d_gtb = D('goods_to_buy');
        $data = $d_gtb->where($condition)->select();
        $objPHPExcel = new \PHPExcel();
        /*以下是一些设置 ，什么作者  标题啊之类的*/
        $objPHPExcel->getProperties()->setCreator("转弯的阳光")
            ->setLastModifiedBy("转弯的阳光")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("备份数据")
            ->setKeywords("excel")
            ->setCategory("result file");
            //设置标题
            //品名材质规格宽长厂家地区仓库计重方式价格重量
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . 1, '品名')
                        ->setCellValue('B' . 1, '材质')
                        ->setCellValue('C' . 1, '规格')
                        ->setCellValue('D' . 1, '采购量')
                        ->setCellValue('E' . 1, '产地/厂家')
                        ->setCellValue('F' . 1, '收货地')
                        ->setCellValue('G' . 1, '报价要求')
                        ->setCellValue('H' . 1, '联系人')
                        ->setCellValue('I' . 1, '电话');
                        
            foreach ($data as $k => $v) {
                $num = $k + 2;
                $objPHPExcel->setActiveSheetIndex(0)
                    
                    ->setCellValue('A' . $num, $v['product_name'])
					->setCellValue('B' . $num, $v['product_material'])
					->setCellValue('C' . $num, $v['product_specifications'])
					->setCellValue('D' . $num, $v['quantity'])
					->setCellValue('E' . $num, $v['manufacturer'])
					->setCellValue('F' . $num, $v['delivery_place'])
					->setCellValue('G' . $num, $v['price_conditions'])
					->setCellValue('H' . $num, $v['linkman'].$v['title'])
                    ->setCellValue('I' . $num, $v['telephone']);
					
            }

        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
		$this->display("Admin:fabu_order");
    }
    public function my_shopping_cart(){
    	
    	$d_order=D("order");
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
		$condition["order_status"]=0;
	    
		$count = $d_order->where($condition)->count();
        $Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
		
		$result=$d_order->where($condition)->relation("goods")->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign("cart_items_num",$count);
		$this->assign("cart_items",$result);
		$this->assign("page",$show);
        $tpl="Admin:my_shopping_cart";
        $this->display($tpl);
    }

    public function my_focus(){
        $tpl = "Admin:my_focus";
        $this->display($tpl);
    }

    public function my_infos(){
    	$user_info=Holder::getUser();
		$m_user=M("user");
		$result=$m_user->where("id=".$user_info["id"])->find();

		$this->assign("user_info",$result);
        $tpl = "Admin:my_infos";
        $this->display($tpl);
    }

    public function company_infos(){
        $tpl="Admin:company_infos";
        $user_info = Holder::getUser();
        $this->display($tpl);
    }

    public function my_nums(){
        $tpl = "Admin:my_nums";
        $this->display($tpl);
    }

    public function my_order(){
    	
		
		$parameter["order_status"]=$_GET["order_status"];
		$parameter["shipping_status"]=$_GET["shipping_status"];
		if(!is_null($parameter["order_status"])){
			$condition["order_status"]=$parameter["order_status"];
		}
		else{
		    $condition["order_status"]=array("not in",array("0","9"));//购物车和已经删除订单不予呈现		
		}
		if(!is_null($parameter["shipping_status"])){
			$condition["shipping_status"]=$parameter["shipping_status"];
		}
	
		$d_order=D("order");
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
	
		//查询所有处于购物车和被删除以外状态的订单
		$total_count=$d_order->where("user_id=".$user_info["id"]." and order_status!=0 and order_status!=3")->count();
	
		//等待付款的订单
		$unpaid_count=$d_order->where("user_id=".$user_info["id"]." and order_status=1")->count();
		
		//已经付款等待发货
		$non_delivery_count=$d_order->where("user_id=".$user_info["id"]." and  shipping_status=1")->count();
		
		//已经发货
		$delivered_count=$d_order->where("user_id=".$user_info["id"]." and shipping_status=2")->count();
	
		$count = $d_order->where($condition)->count();
        $Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();
		$result=$d_order->where($condition)->relation(array("goods","seller_company"))->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("order_items",$result);
		$this->assign("page",$show);
		$this->assign("total_num",$total_count);
		$this->assign("non_delivery_num",$non_delivery_count);
		$this->assign("unpaid_num",$unpaid_count);
		$this->assign("delivered_num",$delivered_count);
		
        $tpl = "Admin:my_order";
        $this->display($tpl);
    }

    public function my_saleorder(){
    	
		
		$parameter["order_status"]=$_GET["order_status"];
		$parameter["shipping_status"]=$_GET["shipping_status"];
		if(!is_null($parameter["order_status"])){
			$condition["order_status"]=$parameter["order_status"];
		}
		else{
		    $condition["order_status"]=array("not in",array("0","9"));//购物车和已经删除订单不予呈现		
		}
		if(!is_null($parameter["shipping_status"])){
			$condition["shipping_status"]=$parameter["shipping_status"];
		}
		
		$d_order=D("order");
		$user_info=Holder::getUser();
		$condition["order_seller"]=$user_info["id"];
	
		//查询所有处于购物车和被删除以外状态的订单
		$total_count=$d_order->where("order_seller=".$user_info["id"]." and order_status!=0 and order_status!=3")->count();

		//等待付款的订单
		$unpaid_count=$d_order->where("order_seller=".$user_info["id"]." and order_status=1")->count();
		
		//已经付款等待发货
		$non_delivery_count=$d_order->where("order_seller=".$user_info["id"]." and shipping_status=1")->count();
		
		//已经发货
		$delivered_count=$d_order->where("order_seller=".$user_info["id"]." and shipping_status=2")->count();
	    			
		$count = $d_order->where($condition)->count();
        $Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
		
		$result=$d_order->where($condition)->relation(array("goods","buyer_company"))->limit($Page->firstRow.','.$Page->listRows)->select();
		
		
		$this->assign("order_items",$result);
		$this->assign("page",$show);
		$this->assign("total_num",$total_count);
		$this->assign("non_delivery_num",$non_delivery_count);
		$this->assign("unpaid_num",$unpaid_count);
		$this->assign("delivered_num",$delivered_count);
		$this->assign("page",$show);
    
        $tpl="Admin:my_saleorder";
        $this->display($tpl);
    }

    public function my_safe(){
        $tpl = "Admin:my_safe";
        $this->display($tpl);
    }

    public function my_resource(){
        $tpl = "Admin:my_resource";
        $this->display($tpl);
    }
    public function fabu_cuxiao(){
        $tpl = "Admin:fabu_cuxiao";
        $this->display($tpl);
    }

    public function fabu_goods(){
			
    	
		
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
		$condition["is_promotional"]=0;
		
		$parameter["is_listed"]=$_GET["is_listed"];
		$parameter["approval_status"]=$_GET["appr_stat"];
	    if(!is_null($parameter["is_listed"])){
	      $condition["is_listed"]=$parameter["is_listed"];	
	    }
		
		if(!is_null($parameter["approval_status"])){
	      $condition["approval_status"]=$parameter["approval_status"];	
	    }
		
		 
	
    	$m_spot_goods_record=M("spot_goods_record");
		
		$count_total = $m_spot_goods_record->where("user_id=".$user_info["id"]." and is_promotional=0")->count();// 查询满足要求的总记录数
		
		$count_listed=$m_spot_goods_record->where("user_id=".$user_info["id"]." and is_promotional=0 and is_listed=1")->count();
	
		$count_not_listed=$m_spot_goods_record->where("user_id=".$user_info["id"]." and is_promotional=0 and is_listed=0")->count();
	
		$count_not_approvaled=$m_spot_goods_record->where("user_id=".$user_info["id"]." and is_promotional=0 and approval_status=0")->count();
		
	
		$count=$m_spot_goods_record->where($condition)->count();
        $Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                    
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
		
		$result=$m_spot_goods_record->where($condition)->order("created_at desc")->limit($Page->firstRow.','.$Page->listRows)->select();
	
	    $this->assign("products",$result);
		$this->assign("page",$show);
		$this->assign("total_num",$count_total);
		$this->assign("listed_num",$count_listed);
		$this->assign("not_listed_num",$count_not_listed);
		$this->assign("not_approvaled_num",$count_not_approvaled);
        $tpl = "Admin:fabu_goods";
	
        $this->display($tpl);
    }


    public function fabu_qiugou(){
        $tpl = "Admin:fabu_qiugou";
        $this->display($tpl);
    }
    //发布促销信息
    public function getPromotionalGoodsInfo(){	
	   $user_info=Holder::getUser();
       $record["product_name"]=$_POST["product_name"];
	   $record["product_material"]=$_POST["product_material"];
	   $record["product_specifications"]=$_POST["product_specifications"];
	   $record["quantity"]=$_POST["quantity"];
	   $record["manufacturer"]=$_POST["manufacturer"];
	   $record["supplier"]=$_POST["supplier"];
	   $record["delivery_place"]=$_POST["area"];
	   $record["unit_price"]=$_POST["price"];     
	   $record["linkman"]=$_POST["linkman"];
	   $record["telephone"]=$_POST["telephone"];
	   $record["title"]=$_POST["title"];
	   $record["approval_status"]=0;
	   $record["created_at"]=time();
	   $record["is_promotional"]=1;	  
	   $record["user_id"]=$user_info["id"];
	   $m_sgr=M("spot_goods_record");
	  
	   if($m_sgr->add($record)){
	   	$this->success("发布成功，请等待审核",U("admin/fabu_sales"));
	   }
	   else{
	   	$this->error("发布失败！",U("admin/fabu_sales"));
	   }
	       	
    }
	
	public function delSpotGoodsRecord(){
		$sgr_id=$_GET["id"];
		$m_sgr=M("spot_goods_record");
		$res=$m_sgr->where("sgr_id=".$sgr_id)->delete();
	
		if($res){
			$this->success('删除成功', U('Admin/fabu_goods'));
		}
		else{
			$this->error('删除失败，请与网站管理员联系 ', U('Admin/fabu_goods'));
		}
	}
	public function getSpotGoodsInfo(){	
	   $user_info=Holder::getUser();
       $record["product_name"]=$_POST["product_name"];
	   $record["product_material"]=$_POST["product_material"];
	   $record["product_specifications"]=$_POST["product_specifications"];
	   $record["product_width"]=$_POST["product_width"];
	   $record["product_length"]=$_POST["product_length"];
	   $record["delivery_place"]=$_POST["delivery_place"];
	   				
	   $record["storehouse_name"]=$_POST["storehouse_name"];
	   $record["quantity"]=$_POST["quantity"];
	   $record["manufacturer"]=$_POST["manufacturer"];
	   $record["weighing_type"]=$_POST["weighing_type"];
	   
	   $record["unit_price"]=$_POST["unit_price"];     
	   $record["weight"]=$_POST["weight"];
	   $record["remark"]=$_POST["remark"];
	   
	   $record["approval_status"]=0;
	   $record["created_at"]=time();
	   	  
	   $record["user_id"]=$user_info["id"];
	   $m_sgr=M("spot_goods_record");
	  
	   if($m_sgr->add($record)){
	   	
		$this->success('发布成功，请等待审核', U('Admin/fabu_goods'));
	   }
	   else{
	   	$this->error('发布失败，请与网站管理员联系', U('Admin/fabu_goods')); 
	   }
	       	
    }

	//发布求购信息
    public function getGoodsInfo(){
       header("content-type:text/html;charset=utf-8");
	   $record["product_name"]=$_POST["product_name"];
	   $record["product_material"]=$_POST["material"];
	   $record["product_specifications"]=$_POST["specifications"];
	   $record["quantity"]=$_POST["quantity"];
	   
	   $record["manufacturer"]=$_POST["factory_name"];
	   
	   $record["delivery_place"]=$_POST["shipping_address"];
	   $record["price_conditions"]=$_POST["price_conditions"];     
	   $record["linkman"]=$_POST["linkman"];
	   $record["telephone"]=$_POST["telephone"];
	   $record["title"]=$_POST["title"];
	   $record["approval_status"]=0;
	   $record["created_at"]=time();
	   
	   $user_info=Holder::getUser();
	   $record["user_id"]=$user_info["id"];
	   
	   $m_goods_to_buy=M("goods_to_buy");
	   if($m_goods_to_buy->add($record)){
	   	$this->success("发布成功，请等待审核",U("Admin/fabu_order"));
	   }
	   else{
	   	$this->error("发布失败！","Admin/fabu_order");
	   }
	  
    }
    
    public function fabu_order(){
    	
		$para["start_time"]=$_GET["time_start"];
		$para["end_time"]=$_GET["time_end"];
		$para["product_name"]=$_GET["product_name"];
	
		if($para["start_time"]!=""&&$para["end_time"]!=""){
			$start_t=strtotime($para["start_time"]);
			$end_t=strtotime($para["end_time"]);	
			$condition["created_at"]=array("between",array($start_t,intval($end_t)+86399));
		}
		if($para["product_name"]!="")
	    {
	   	  $condition["product_name"]=array('like',"%".$para["product_name"]."%");
	    }

           	
    	$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
		$d_gtb=D("goods_to_buy");
		
		$count=$d_gtb->where($condition)->count();
		$Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
    
		$result=$d_gtb->where($condition)->relation("quotations")->limit($Page->firstRow.','.$Page->listRows)->select();
	
        $this->assign("goods",$result);
		$this->assign("page",$show);
        $tpl = "Admin:fabu_order";
        $this->display($tpl);
    }

    public function fabu_sales(){
    	
	    $product_type = I('product_type');
	    $para["manufacturer"]=$_GET["manu_name"];
	    $para["product_name"]=$_GET["prod_name"];
	    if($para["manufacturer"]!=""){
	      $condition["manufacturer"]=array('like',"%".$para["manufacturer"]."%");	
	    }
		
	    if($para["product_name"]!=""){
	      $condition["product_name"]=array('like',"%".$para["product_name"]."%");	
	    }
	
        $d_spot_goods_record = D('spot_goods_record');
		
		
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
		$condition["is_promotional"]=1;
        
        $count = $d_spot_goods_record->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count,5);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        $products = $d_spot_goods_record->where($condition)->order("unit_price")->limit($Page->firstRow.','.$Page->listRows)->select();
		
        $this->assign('products',$products);
        $this->assign('page',$show);
		$tpl="Admin:fabu_sales";
        $this->display($tpl);
    }
	
	//添加到购物车
	public function addToCart()
	{
		$user_info=Holder::getUser();
		$sgr_id=$_GET["id"];
		if(is_null($sgr_id)){
			$this->display("public:error");
			return ;
		}
		$m_sgr=M("spot_goods_record");
		
		$goodsinfo= $m_sgr->where("sgr_id=".$sgr_id)->find();
		
		$order_record["sgr_id"]=$sgr_id;
		$order_record["user_id"]=$user_info["id"];;
		$order_record["order_seller"]=$goodsinfo["user_id"];
		$order_record["created_at"]=time();
		$m_order=M("order");
		$res=$m_order->add($order_record);
		if(!$res){
			$this->error("添加失败！",U("Admin/my_shopping_cart"));
		}
	    $this->my_shopping_cart();
	}

    public function check_fapiao(){
        $tpl="Admin:check_fapiao";
        $this->display($tpl);
    }
    public function bao_jia(){
        $tpl="Admin:bao_jia";
        $this->display($tpl);
    }
	public function test(){
		
	}
	//批量删除现货记录
	public function deletSpotGoods_batch(){
		$ids=$_POST["items_selected"];
		$condition["sgr_id"]=array("in",$ids);
		$m_spot_goods_record=M("spot_goods_record");
		$res=$m_spot_goods_record->where($condition)->delete();
		if($res){
			$this->success("删除成功！",U("Admin/fabu_goods"));
		}
		else{
			$this->error("删除失败！",U("Admin/fabu_goods"));
		}
	}
	//用户的所有现货全部挂牌
	public function setAllGoodsListed_batch(){
		$ids=$_POST["items_selected"];
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
		
		$record["is_listed"]=1;
		$m_spot_goods_record=M("spot_goods_record");
		$res=$m_spot_goods_record->where($condition)->save($record);
		
		if($res!=false){
			$this->success("所有条目已挂牌！",U("Admin/fabu_goods"));
		}
		else{
			$this->error("执行失败！",U("Admin/fabu_goods"));
		}
	}
	
	//用户的所有现货全部摘牌 
	public function setAllGoodsNotListed_batch(){
		$ids=$_POST["items_selected"];
		$user_info=Holder::getUser();
		$condition["user_id"]=$user_info["id"];
		
		$record["is_listed"]=0;
		$m_spot_goods_record=M("spot_goods_record");
		$res=$m_spot_goods_record->where($condition)->save($record);
		if($res!=false){
			$this->success("所有条目已摘牌！",U("Admin/fabu_goods"));
		}
		else{
			$this->error("执行失败！",U("Admin/fabu_goods"));
		}
	}
	
	
	//批量挂牌
	public function setGoodsListed_batch(){
		$ids=$_POST["items_selected"];
		$condition["sgr_id"]=array("in",$ids);
		$record["is_listed"]=1;
		$m_spot_goods_record=M("spot_goods_record");
		$res=$m_spot_goods_record->where($condition)->save($record);
		if($res!=false){
			$this->success("选中条目已挂牌！",U("Admin/fabu_goods"));
		}
		else{
			$this->error("执行失败！",U("Admin/fabu_goods"));
		}
	}
	//批量摘牌
	public function setGoodsNotListed_batch(){
		$ids=$_POST["items_selected"];
		$condition["sgr_id"]=array("in",$ids);
		$record["is_listed"]=0;
		$m_spot_goods_record=M("spot_goods_record");
		$res=$m_spot_goods_record->where($condition)->save($record);
		if($res!=false){
			$this->success("选中条目已摘牌！",U("Admin/fabu_goods"));
		}
		else{
			$this->error("执行失败！",U("Admin/fabu_goods"));
		}
	}
	//批量删除求购商品记录
	public function deletQiugou_batch(){
		$result=$_POST["items_selected"];
	}
	//批量删除订单
	public function deletOrders_batch(){
		$ids=$_POST["items_selected"];
		dump($ids);
	}
	
	public function deleteOrder(){
		//删除订单
	}
	//删除单个求购信息
	public function deleteQiugouInfo(){
		$gtb_id=$_GET["id"];
		$m_goods_to_buy=M("goods_to_buy");
		$m_gq=M("goods_quotation");
	
		$res=$m_goods_to_buy->where("gtb_id=".$gtb_id)->delete();
	
		$m_gq->where("gtb_id=".$gtb_id)->delete();
		//报价信息可能不存在 所以删除返回值可能为0 
	
		if(!$res){
			$this->error("删除失败！",U("Admin/fabu_order"));
			return ;
		}
	
		$this->success("删除成功！",U("Admin/fabu_order"));
		
	}
	
	public function updateQiugouInfo(){
		$record["gtb_id"]=$_POST["gtb_id"];
		$record["product_name"]=$_POST["product_name"];
		$record["product_material"]=$_POST["product_mater"];
		$record["quantity"]=$_POST["quantity"];
		$record["product_specifications"]=$_POST["product_spec"];
		$expired_time=$_POST["expired_time"];
		$record["expired_time"]=strtotime($expired_time);
		$record["approval_status"]=0;
		$record["created_at"]=time();
		
		
		$m_goods_to_buy=M("goods_to_buy");
		$m_goods_quotation=M("goods_quotation");
	
		$res=$m_goods_to_buy->save($record);
		if(!$res){
			$this->error("修改失败",U("Admin/fabu_order"));
			return ;
		}
		
		$m_goods_quotation->where("gtb_id=".$record["gtb_id"])->delete();
		
		$this->success("修改成功",U("Admin/fabu_order"));
		
	}
	
	//第一个支付页面
	public function payStep1(){
		$items_selected=$_POST["items_selected"];
		$items_amount=$_POST["items_amount"];
		dump($items_selected);
		dump($items_amount);
	}
	
	
}

