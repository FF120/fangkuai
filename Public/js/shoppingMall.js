//现货商城相关代码


(function(){
	//点击后获得焦点样式
	var right_tab = $('.content_form_right_tab').find('li');
	var right_list = $('.content_form_right_list');

	tabChange(right_tab,right_list,'active')

	function tabChange($tabArr,$content,classN){
		$tabArr.each(function(index){
			$(this).on('click',function(){
				$tabArr.removeClass(classN);
				$content.hide();
				$(this).addClass(classN);
				$content.eq(index).show();
			});
		});
	}

})();
//特钢大卖场
(function(){
	$('#big_shop').on('mouseover',function(){
		$('#shopping_list').show();
	}).on('mouseout',function(){
		$('#shopping_list').hide();
	});
})();
(function(){
	//我的订单
	$('#my_dng_btn').on('mouseover',function(){
		$('#my_dng').show();
	}).on('mouseout',function(){
		$('#my_dng').hide();
	});
})();
(function(){
	//锁货列表
	$('#c_f_r_list1 .dele').on('click',function(){
		$(this).parents('li').remove();
		getAll();
		
	});
	$('#deletAll').on('click',function(){
		$(this).siblings('li').remove();
		getAll();
		
	});
	$('#c_f_r_list1 input').on('change',function(){
		getAll();
	});
	function getAll(){
		var allNum=allWeight=allMoney=0;

		var priceArr  = $('#c_f_r_list1 li').find('.price');
		var numArr    = $('#c_f_r_list1 li').find('input');
		var weightArr = $('#c_f_r_list1 li').find('.weight');
		var $bottom = $('.bottom')

		priceArr.each(function(index){
			var price  = parseFloat($(this).html());
			var weight = parseFloat(weightArr.eq(index).html());
			var num    = parseFloat(numArr.eq(index).val());
			var money  = price*weight*num;

			allNum    += num;
			allWeight += weight*num;
			allMoney  += money;			
		});

		allWeight = allWeight.toFixed(2);
		allMoney  = allMoney.toFixed(2);

		$bottom.find('.allNum').html(allNum);
		$bottom.find('.allWeight').html(allWeight);
		$bottom.find('.allMoney').html(allMoney);

	}
	
})();