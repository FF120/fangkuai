<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/23
 * Time: 20:35
 */

function qiugou_status_to_show($status){
    switch($status){
    	
		case 0:return "待审核";break;
		case 1:return "选标中";break;
		case 2:return "比价中";break;
		case 3:return "成交";break;
        default:return "未知֪";break;
    }
} 
function order_status_to_show($status){
    switch($status){
    	/*
        case 0:return "刚生成";break;
        case 2:return "购物车";break;
        case 3:return "已付款";break;
        case 4:return "已删除";break;
		 */
		case 0:return "购物车";break;
		case 1:return "待付款";break;
		case 2:return "已付款";break;
		case 9:return "已删除";break;
        default:return "未知֪";break;
    }
}
function shipping_status_to_show($status){
	switch($status){
		case 0:return  "--";break;//未付款时此项无意义
		case 1:return "待发货";break;
		case 2:return "已发货";break;
		case 3:return "已收货";break;
        default:return "未知֪";break;
    }
}

function listed_status_to_show($status){
    switch($status){
    	case 0:return "未挂牌";break;
        case 1:return "已挂牌";break;
        default:return "未知֪";break;
    }
}

function order_invoice_status_to_show($status){
    switch($status){
    	case 0:return "未开票";break;
        case 1:return "已开票";break;
        default:return "未知֪";break;
    }
}
function promotional_status_to_show($status){
	switch($status){
    	case 0:return "待审核";break;
        case 1:return "出售中";break;
        default:return "未知֪";break;
    }
}
