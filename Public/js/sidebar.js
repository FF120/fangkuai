document.writeln('<style>');
document.writeln('	body,li,ul{ padding:0; margin:0; list-style: none; font-family: "微软雅黑"}');
document.writeln('	input,option,textarea{ font-size: inherit; line-height: 1.4;}');
document.writeln('		.fl{ float: left;}.fr{ float: right;}.hidden{ overflow: hidden;}');
document.writeln('		#sidebar{z-index:1500; width: 37px; height: auto; background-color: #494949; position: fixed; right: 0; top:0;}');
document.writeln('		.topBar{ margin-top: 108px; cursor: pointer;}');
document.writeln('		.topBar .car{ width: 37px; height: 80px; padding-top: 30px; background: url(../../../Public/images/red_car.png) 10px 10px no-repeat;text-align: center; font-size: 12px; color:#FFF; position: relative;}');
document.writeln('		.topBar .car:hover{ background-color:#ffaa01; background-image: url(../../../Public/images/wite_car.png);}');
document.writeln('		.topBar .car .num{background-color: #e03427; border-radius: 4px; padding:2px 6px;}');
document.writeln('		.topBar .topbtn{ width: 37px; height: 40px; margin-top: 10px; position: relative;}');
document.writeln('		.topBar .topbtn:hover{background-color:#ffaa01;}');
document.writeln('		.topBar .kefu{  background:url(../../../Public/images/kefu.png) 9px 10px no-repeat;}');
document.writeln('		.topBar .fankui{  background:url(../../../Public/images/fankui.png) 8px 10px no-repeat;}');
document.writeln('		.topBar .yanshi{  background:url(../../../Public/images/yanshi.png) 8px 14px no-repeat;}');
document.writeln('		.topBar .topbtn span{ padding:13px 15px; background-color:#333333; position: absolute;top:0px; left: -136px; font-size: 12px;color:#FFF; letter-spacing: 2px; opacity: 0; display: none;}');

document.writeln('	.topBar .topbtn span i{ padding:7px 7px;  font-size: 0px; ');
document.writeln('	background:url(../../../Public/images/sanjiao.png) no-repeat; position: absolute; ');document.writeln('right: -13px; top:13px;}');

document.writeln('.topBar .car i{ padding:7px 7px;font-size: 0px;position: absolute;display:none;');
document.writeln('background:url(../../../Public/images/wite_sanjiao.png) no-repeat;left:-1px; top:45px;}');

document.writeln('#carBox{ width: 355px; background-color:#FFF; position: fixed; display: none;top:3px; right:-320px; border: 1px solid #CCC; color:#666; z-index:1400}');
document.writeln('		#carBox .carBoxTop{ padding:0 10px;}');
document.writeln('		#carBox .carBoxTop h1{ text-align: left; line-height:2; font-size: 14px; }');
document.writeln('		#carBox .carBoxTop input,#carBox .carBoxBottom input{ width: 330px; height: 40px; border-radius: 4px; background-color: #ff9900; border:1px solid #e68a00; color: #FFF; font-size: 16px; letter-spacing: 2px; font-weight: bold;}');	
document.writeln('		#carBox .carBoxBottom{ border-top:1px solid #ccc; border-bottom:1px solid #ccc; overflow: hidden; margin:20px 0;}');
document.writeln('		#carBox .submitbox{ position: relative;}');
document.writeln('		#carBox .submitbox input{cursor: pointer;}');
document.writeln('		#carBox .submitbox span{ width: 18px; height:18px; border-radius: 10px; background-color: #FFF; position: absolute; top:10px; left:230px; display: block; color:#ff5715; font-size: 17px; line-height: 16px; text-align: center;}');
document.writeln('		#carBox .allTop{ margin:15px 0;}');
document.writeln('		#carBox .allTop span{ color:#ff9900;}');
document.writeln('		#carBox .carBoxContent{ border-top:1px solid #CCC; position: relative;}');
document.writeln('		#carBox .carBoxContent i{ padding:7px 7px;  font-size: 0px; background:url(../../../Public/images/wite_sanjiao.png) no-repeat; position: absolute; right: -13px; top:45px;}');
document.writeln('		#carBox .carBoxContent h3{ font-weight: normal; font-size: 14px; background-color: #f0f0f0; line-height: 1em; padding:8px 10px; margin:0;}');
document.writeln('		#carBox .carBoxContent li{ padding:5px 10px; line-height: 2em; border-bottom:1px solid #CCC;}');
document.writeln('		#carBox .carBoxContent li:hover{ background-color: #f6f6f6;}');
document.writeln('		#carBox .carBoxContent li .close{ background-color: #999; border-radius: 7px; color:#FFF; font-size:12px; padding:1px 3px; line-height: 1em; margin:5px 4px 0 0px;}');
document.writeln('		#carBox .carBoxContent li .close:hover{ background-color: #ff9900;}');
document.writeln('	</style>');

document.writeln('<form id="carBox" action="" method="post"><div class="carBoxTop"><h1>我的购物车</h1><div class="submitbox"><input type="submit" value="去购物车结算"> <span>></span></div><div class="allTop hidden"><div class="allNum fl">共<i style="padding:0 5px" id="top_allNum">0</i>吨</div><div class="allMoney fr">总价：<span id="top_allMoney">0</span></div></div></div><div class="carBoxContent"><ul><h3 class="hidden"><span class="fl">山西商都商贸有限公司</span> <span class="fr">￥4567.5</span></h3><li><div class="itemName hidden"><input style="margin-top:7px" class="fl" type="checkbox"> <span class="fl">太钢 高强板 TQ700MCD 4*1000*9000 过磅</span> <a class="fr close">X</a></div><div class="itemMoney hidden" style="padding:0 5px"><div class="allNum fl">共<span>9.44</span>吨</div><div class="allMoney fr">总价：<span>9999.99</span></div></div></li><li><div class="itemName hidden"><input style="margin-top:7px" class="fl" type="checkbox"> <span class="fl">太钢 高强板 TQ700MCD 4*1000*9000 过磅</span> <a class="fr close">X</a></div><div class="itemMoney hidden" style="padding:0 5px"><div class="allNum fl">共<span>9.44</span>吨</div><div class="allMoney fr">总价：<span>9999.99</span></div></div></li></ul><ul><h3 class="hidden"><span class="fl">山西商都商贸有限公司</span> <span class="fr">￥4567.5</span></h3><li><div class="itemName hidden"><input style="margin-top:7px" class="fl" type="checkbox"> <span class="fl">太钢 高强板 TQ700MCD 4*1000*9000 过磅</span> <a class="fr close">X</a></div><div class="itemMoney hidden" style="padding:0 5px"><div class="allNum fl">共<span>9.44</span>吨</div><div class="allMoney fr">总价：<span>9999.99</span></div></div></li><li><div class="itemName hidden"><input style="margin-top:7px" class="fl" type="checkbox"> <span class="fl">太钢 高强板 TQ700MCD 4*1000*9000 过磅</span> <a class="fr close">X</a></div><div class="itemMoney hidden" style="padding:0 5px"><div class="allNum fl">共<span>9.44</span>吨</div><div class="allMoney fr">总价：<span>9999.99</span></div></div></li></ul></div><div class="carBoxBottom"><div class="submitbox" style="margin:10px 0"><input style="width:100px;margin-left:235px" type="submit" value=""> <span style="left:264px;width:2em;color:#FFF;background-color:#f90">结算</span> <span style="left:308px">></span> <span style="left:10px;width:auto;font-size:14px;color:#666">已选购<i id="btm_allNum" style="padding:0 5px">0</i>吨</span> <span style="left:128px;width:auto;font-size:14px;color:#666">总价：<i id="btm_allMoney">0</i></span></div></div></form><div id="sidebar"><ul class="topBar"><li class="car"><i id="car_sanjiao"></i> <span>购<br>物<br>车<br></span><div style="margin-top:7px"><span class="num">2</span></div></li><li class="kefu topbtn"><span>在线客服<i></i></span></li><li class="fankui topbtn"><span>意见反馈<i></i></span></li><li class="yanshi topbtn"><span>流程须知<i></i></span></li><li style="margin-top:80px" class="kefu topbtn"><span style="top:-66px"><img src="../../../Public/images/erweima_side.jpg" alt=""><br>扫二维码<i style="top:80px"></i></span></li><li class="fankui topbtn"><span>流程视频<i></i></span></li><li class="yanshi topbtn"><span>返回顶部<i></i></span></li></ul></div>');

$(function(){
		
	$('#sidebar').height($(window).height());
	$('#carBox').height($(window).height()).css({'overflow-x':'hidden','overflow-y':'auto'});
	$('#sidebar .topbtn').on('mouseover',function(){
		$(this).find('span').css('display','block').stop().animate({left:'-94px',opacity:'1'},300);
	}).on('mouseout',function(){
		$(this).find('span').stop().animate({left:'-136px',opacity:'0'},300,function(){$(this).css('display','none')});
	});

	$('#sidebar .car').on('click',function(e){//弹出购物车
			e.stopPropagation();
			var right = parseInt($('#carBox').css('right'));
			if(right==-320){
				$('#carBox').css('display','block').animate({right:'37px'},300,function(){
					$('#car_sanjiao').css('display','block');
				});			
			}else if(right==37){
				$('#carBox').css('display','block').animate({right:'-320px'},300,function(){
					$('#car_sanjiao').css('display','none');
				});
			}
		});


	$('#carBox').find(':checkbox').on('click',function(){//计算总额
		
		account();
	});

	$('#carBox .carBoxContent .close').on('click',function(){
		var parent = $(this).parent().parent();
		if(parent.siblings().size()==1){
			parent.parent().remove();
		}else{
			parent.remove();
		}
		account();
	});

	function account(){//总数&金额计算函数
		var itemMoney = $('.carBoxContent').find('input:checked').parent().siblings('.itemMoney');
		var allNumItem = itemMoney.find('.allNum').find('span');
		var allMoneyItem = itemMoney.find('.allMoney').find('span');
		var allNum = 0,allMoney = 0;
		console.log(itemMoney.size());

		allNumItem.each(function(){
			allNum+=parseFloat($(this).html()); 
		});

		allMoneyItem.each(function(){
			allMoney+=parseFloat($(this).html()); 
		});

		 $("#top_allNum,#btm_allNum").html(allNum);

		 $("#top_allMoney,#btm_allMoney").html(allMoney);
	}

});