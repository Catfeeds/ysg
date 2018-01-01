 // 商务通弹出图片链接
 
//document.writeln("<div id=\'dingwei\' style=\'width:580px; height:350px; position:fixed; left:50%; top:50%; margin:-175px 0 0 -290px; z-index:10008; \'>");
//document.writeln("<img src=\'../images/shangwutong88.gif\'/*tpa=http://www.ysg.cn/templets/ysg/images/shangwutong88.gif*/  width=\'580\' height=\'350\' class=\'img_shadow\' usemap=\'#swt_center\' border=\'0\'/><map name=\'swt_center\'><area  shape=\'rect\' coords=\'542,0,580,35\' href=\'javascript:;\' onclick=\'yicang()\'  /><area shape=\'poly\' coords=\'1,0,535,1,536,40,580,40,580,354,-8,349\' href=\'javascript:;\'  onclick=\'online()\'  /></map></div>");


var LiveAutoInvite0='';
var LiveAutoInvite1='';
var LrinviteTimeout=1;
var LR_next_invite_seconds = 3;
//商务通弹出图片


function online(){
	//上午通弹窗代码
	var e = 'anniu';
	if(arguments.length == 1){
		e = arguments[0];
	}
	var url = 'http://swt.ysg.cn/LR/Chatpre.aspx?id=KMM23720509';
	url = url + '&e=' + e + '&p=' + encodeURIComponent(location.href);
	window.open(url, 'news' + Math.round( Math.random() * 1000000 ));
	return false;
}
function chuxian(){
	document.getElementById('dingwei').style.display='block';
	}
setTimeout("chuxian()", 4000);
	
function yicang(){
	document.getElementById('dingwei').style.display='none';
	
	}

/*

function ddl(){
   $('body').find('.fixzixuntai').hide()
           $('body').find('#LRfloater0').hide()
           $('body').find('#qiao-wrap').hide()
	   $('body').find('.fixzixuntai').hide()
}


$(function(){
	var url = window.top.location
	var reg1 = /57727777.com/
	if(reg1.test(url) )
	setInterval('ddl()',1)
})
*/
function abc(){
		document.getElementById('k_s_ol_inviteWin').style.display='none'	
	}
	
	function tjtj() {
		var sx = document.getElementById("xs");
		if (sx) {
			sx.style.display='block'
		}
		var nb_nodeboard_form = document.getElementById("nb_nodeboard_form");
		if (nb_nodeboard_form) {
			nb_nodeboard_form.style.display='block'
		}
	}

	
	function onf(){
			document.getElementById("nb_nodeboard_set_phone").value ="";	
			
	}
	function onb(){
			var country = document.getElementById("nb_nodeboard_set_phone").value;	
			if (country.length<1){
				document.getElementById("nb_nodeboard_set_phone").value ="请输入您的手机号码"
			}
			
	}
	
	function updateSwt() {
		var center = document.getElementById("k_s_ol_inviteWin");
		if (center) {
			center.style.display='block'
		}
		
	}

	window.setInterval("updateSwt()", 12000);






document.writeln("<style type=\"text/css\">");
document.writeln(".fixzixuntai{ background:url(http://www.ysg.cn/templets/ysg/images/zixun1.png) no-repeat; width:134px; height:511px; position:fixed; left:10px; top:100px; z-index:9999; text-align:left;}");
document.writeln(".fixzixuntai ul{ padding:170px 0 0 10px; width:114px; height:300px;}");
document.writeln(".fixzixuntai ul li{ height:30px; padding-bottom:4px; width:114px; margin:0;}");
document.writeln(".fixzixuntai ul li a{ display:block; height:30px; line-height:30px; background:#fe7c04; padding-left:32px; color:#fff; font-size:12px; font-family:\"微软雅黑\";}");
document.writeln(".fixzixuntai ul li.fix_zxt1 a{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px 0 #fe7c04;}");
document.writeln(".fixzixuntai ul li.fix_zxt1 a:hover{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -30px #9d592c;}");
document.writeln(".fixzixuntai ul li.fix_zxt2 a{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -60px #fe7c04;}");
document.writeln(".fixzixuntai ul li.fix_zxt2 a:hover{ background:url(http://www.ysgjt.com/images/zixuntai_pic.jpg) no-repeat -5px -90px #9d592c;}");
document.writeln(".fixzixuntai ul li.fix_zxt3 a{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -120px #fe7c04;}");
document.writeln(".fixzixuntai ul li.fix_zxt3 a:hover{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -150px #9d592c;}");
document.writeln(".fixzixuntai ul li.fix_zxt4 a{ background:url(http://www.ysgjt.com/images/zixuntai_pic.jpg) no-repeat -5px -180px #fe7c04;}");
document.writeln(".fixzixuntai ul li.fix_zxt4 a:hover{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -210px #9d592c;}");
document.writeln(".fixzixuntai ul li.fix_zxt5 a{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -240px #fe7c04;}");
document.writeln(".fixzixuntai ul li.fix_zxt5 a:hover{ background:url(http://www.ysg.cn/templets/ysg/images/zixuntai_pic.jpg) no-repeat -5px -270px #9d592c;}");
document.writeln(".fixzixuntai_close{ height:35px;}");
document.writeln(".fixzixuntai_close span{ width:30px; height:30px; margin-top:4px;  float:right; display:block; text-indent:-9999px; cursor:pointer;}");
document.writeln(".img_shadow{box-shadow:0px 0px 8px 5px rgba(51,51,51,0.16);}");
document.writeln("</style>");
document.writeln("<div class=\"fixzixuntai png\">");
document.writeln("	<div class=\"fixzixuntai_close\"><span></span></div>");
document.writeln("	<ul>");
document.writeln("		<li class=\"fix_zxt1\"><a href=\"javascript:void(0)\" onclick=\"online()\">免费索取资料</a></li>");
document.writeln("		<li class=\"fix_zxt3\"><a href=\"javascript:void(0)\" onclick=\"online()\">在线疑问解答</a></li>");
document.writeln("		<li class=\"fix_zxt4\"><a href=\"javascript:void(0)\" onclick=\"online()\">创业报价</a></li>");
document.writeln("		<li class=\"fix_zxt5\"><a href=\"javascript:void(0)\" onclick=\"online()\">投资预算</a></li>");
document.writeln("	</ul>");
document.writeln("</div>");
