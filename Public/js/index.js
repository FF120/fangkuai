/*方块网*/
/*2015.08.26,BY-LiangPengFei*/
try{
	if($(document) instanceof jQuery){
		//alert('jQuery')
	}
}catch(e){
	document.write("<script type=\"text/javascript\" src=\"http:\/\/libs.baidu.com/jquery\/1.9.0\/jquery.js\"></script>	");
}
//tab切换&&banner切换代码
function tab(parmObj){
	var $tabBox = $('#'+parmObj.tabBoxId).find(parmObj.tabItemTag),
		$contentBox = $('#'+parmObj.contentBoxId).find(parmObj.contentItemTag),
		$autoChange = parmObj.autoChange,
		activeClass = parmObj.activeClass;
	var timer,index = 0,length = $tabBox.size();

	var eventType = parmObj.eventType || 'mouseover';

	$tabBox.each(function(i){
		$(this).on(eventType+' click',function(e){
			e.stopPropagation();
			index = i;
			$tabBox.removeClass(activeClass).eq(index).addClass(activeClass);
			$contentBox.hide().eq(index).show();
		});
	});

	//banner
	var changeIndex = function(){
		index++;
		index = (index <= (length-1))?index:0;
	}
	var timerFunc = function(){
		changeIndex();
		$tabBox.eq(index).click();
	}

	$('#'+parmObj.contentBoxId).parent().on('mouseover',function(){
		if($autoChange){
			clearInterval(timer);
		}
	}).on('mouseout',function(){
		if($autoChange){
			timer = setInterval(timerFunc,3000);
		}
	});

	if($autoChange){
		timer = setInterval(timerFunc,3000);
	}
}

//点击前后切换内容
function clickTab(nextBtnId,prevBtnId,contentId,findFlag){
	var nextBtn = $('#'+nextBtnId);
	var prevBtn = $('#'+prevBtnId);
	var content = $('#'+contentId).find(findFlag);
	var length  = content.size();
	var index = 0;
	var timer = null;

	var changeIndex = function(boolean){
		if(boolean){
			index++;
			if(index > length-1){ index = 0;}
		}else{
			index--;
			if(index < 0){ index=length-1;}
		}
	}
	var showItem = function(){
		content.hide().eq(index).show();
	}

	$('#'+contentId).on('mouseover',function(){
		clearInterval(timer);
	}).on('mouseout',function(){
		timer = setInterval(function(){
			nextBtn.click();
		},3000);
	});

	nextBtn.on('click',function(){
		changeIndex(true);
		showItem();

	});
	prevBtn.on('click',function(){
		changeIndex(false);
		showItem();
	});

	timer = setInterval(function(){
		nextBtn.click();
	},3000);

}

//订单滚动代码
function dingDanScroll(parent_boxId,dingdan_boxId){
	var parent_box = $('#'+parent_boxId);
	var dingdan_box = $('#'+dingdan_boxId);

	var clone_dingdan = dingdan_box.clone(true);
	var height = parent_box.height();console.log(height);

	var timer = null;
	var step = 0;

	parent_box.append(clone_dingdan);

	parent_box
	.on('mouseover',function(){
		clearInterval(timer);
	})
	.on('mouseout',function(){
		timer = setInterval(function(){
			timerFunc();
		},36);
	});
	
	timer = setInterval(function(){
		timerFunc();
	},36);

	function timerFunc(){
		step++;
		if(step>height){step=0}
		parent_box.css({'top':'-'+step+'px'});

		if(step >= height){
			parent_box.css('top','0px');
		}	
		
	}

}
