(function(){
	$.fn.alertWidgist=function(templUrl){
		var wHeight = window.innerHeight;//浏览器高度
		var wWidth = window.innerWidth;

		this.click(function(){
			var $mark = $('<div class="mark"></div>');//遮罩层
			$mark.css({
				width:wWidth+'px',
				height:wHeight+'px',
				backgroundColor:'#000',
				position:'absolute',
				top:'0',
				left:'0',
				zIndex:'1000',
				opacity:'0'
			});

			var $alertBox = $('<div id="alert_box"></div>');
			$alertBox.css({
				width:444+'px',
				height:210+'px',
				backgroundColor:'#FFF',
				position:'absolute',
				top:'50%',
				left:'50%',
				margin:'-222px 0 0 -222px',
				zIndex:'1100',
				opacity:'0'
			});
			var closeBtn = $('<div>X</div>');
			closeBtn.css({
				width:'40px',
				height:'40px',
				cursor:'pointer',
				backgroundColor:'#FF5500',
				color:'#FFF',
				position:'absolute',
				top:'50%',
				left:'50%',
				margin:'-242px 0 0 200px',
				borderRadius:'20px',
				fontSize:'20px',
				lineHeight:'40px',
				zIndex:'1110',
				textAlign:'center',
				opacity:'0'
			});

			$alertBox.load(templUrl);//载入模板

			var $wrarp = $('<div></div>');//创建包裹层
			$wrarp.append($mark).append($alertBox).append(closeBtn);;

			$('body').append($wrarp);

			$alertBox.animate({opacity:'1'},'fast');
			closeBtn.animate({opacity:'1'},'fast');
			$mark.animate({opacity:'0.5'},'fast');

			// $alertBox.fadeIn('fast');
			// $mark.fadeIn('fast');
			$mark.on('click',function(){
				closeBtn.fadeOut('fast');
				$alertBox.fadeOut(function(){

					$mark.fadeOut('fast',function(){
						$wrarp.remove();
					});
				});
			});
			return closeBtn.on('click',function(){
				$mark.click();
				//$mark.trigger('click');
			});
			
		});
		
	}
})()