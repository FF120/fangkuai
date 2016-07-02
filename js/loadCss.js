$(function(){
	var pageTag = $('body').attr('id');alert(pageTag);
	switch(pageTag){
		case 'qiugou':document.write('<link rel="stylesheet" href="css/user_qiugou.css">');
		break;
		case 'chuxiao':document.write('<link rel="stylesheet" href="css/user_chuxiao.css">');
		break;
		case 'xianhuo':document.write('<link rel="stylesheet" href="css/user_xianhuo.css">');
		break;
		case 'zhiyuan':document.write('<link rel="stylesheet" href="css/user_zhiyuan.css">');
		break;
		case 'guanzu':document.write('<link rel="stylesheet" href="css/user_guanzu.css">');
		break;
		case 'dingdan':document.write('<link rel="stylesheet" href="css/user_dingdan.css">');
		break;
	}
});