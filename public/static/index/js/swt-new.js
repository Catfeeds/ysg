 // 商务通弹出图片链接
 
//document.writeln("<div id=\'dingwei\' style=\'width:580px; height:350px; position:fixed; left:50%; top:50%; margin:-175px 0 0 -290px; z-index:10008; \'>");
//document.writeln("<img src=\'http://www.ysg.cn/templets/ysg/images/shangwutong88.gif\'  width=\'580\' height=\'350\' class=\'img_shadow\' usemap=\'#swt_center\' border=\'0\'/><map name=\'swt_center\'><area  shape=\'rect\' coords=\'542,0,580,35\' href=\'javascript:;\' onclick=\'yicang()\'  /><area shape=\'poly\' coords=\'1,0,535,1,536,40,580,40,580,354,-8,349\' href=\'javascript:;\'  onclick=\'online()\'  /></map></div>");


var LiveAutoInvite0='';
var LiveAutoInvite1='';
var LrinviteTimeout=1;
var LR_next_invite_seconds = 3;
//商务通弹出图片
var domain = document.domain + 'index/index/message';
console.log(domain);
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

function abc(){
		document.getElementById('k_s_ol_inviteWin').style.display='none'	
	}
	
	function tjtj() {
		var country = document.getElementById("nb_nodeboard_set_phone").value;
		var sx = document.getElementById("xs");
		if (sx && (/^1[3|4|5|8|9]\d{9}$/.test(country))) {
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
	
	function tjcheck(){
		var country = document.getElementById("nb_nodeboard_set_phone").value;
		if(!(/^1[3|4|5|7|8|9]\d{9}$/.test(country))){
			var sx = document.getElementById("xs");
			sx.style.display='none';
			
			alert('请输入正确的手机号码！');
			return false;
		}
		return true;
	}

	window.setInterval("updateSwt()", 12000);
/*
document.writeln("<div id=\'k_s_ol_inviteWin\' class=\'ks_ol_comm_div\' style=\'display: block; width: auto; z-index: 2147483647; left: 50%; margin-left: -150px; top: 50%; margin-top: -150px; visibility: visible; position: fixed !important; font-family:Microsoft YaHei; line-height:22px;\'>");
document.writeln("	<div id=\'k_s_ol_inviteWin_fl\'>");
document.writeln("		<div style=\'width:300px; height:300px; background:url(http://www.ganxi.cn/js/boxbj.png) top center no-repeat; background-size:300px auto;\' align=\'center\'>");
document.writeln("			<div align=\'right\'>");
document.writeln("				<div style=\'height:40px; width:40px; cursor:pointer;\' onclick=\'abc()\'></div>");
document.writeln("			</div>");
document.writeln("			<div style=\'padding-top:20px; text-align:center; font-size:14px; color:#444444;\'>");
document.writeln("				<p>在线咨询一扫光零食量贩</p>");
document.writeln("				<p>一对一专属服务</p>");
document.writeln("			</div>");
document.writeln("			<div style=\'padding-top:5px; padding-left:20px; line-height:32px; padding-right:20px; text-align:center; font-size:16px; font-weight:bold; color:#f4751e;\'>品牌优势&nbsp;&nbsp;加盟费用&nbsp;&nbsp;近期优惠</div>");
document.writeln("			<form onsubmit=\'return tjcheck()\' method=\'post\'>");
document.writeln("				<div style=\'padding-top:10px;\' align=\'center\'>");
document.writeln("					<div align=\'center\'>");
document.writeln("						<input id=\'content2\' name=\'content\' value=\'请快速免费回电!\' type=\'hidden\'>");
document.writeln("						<input name=\'username\' class=\'bjname\' id='nb_nodeboard_set_name' value=\'\' placeholder=\'姓名\' style=\'font-family: Microsoft YaHei; font-size:14px; background:#ffffff; color:#555555; text-indent:10px;width:200px; height:32px; border:1px solid #9a9a9a; line-height:32px; border-radius:4px; outline:none; margin-bottom:5px;\' >");
document.writeln("						<input name=\'telephone\' type=\'text\' id=\'nb_nodeboard_set_phone\' style=\'font-family: Microsoft YaHei; font-size:14px; background:#ffffff; color:#555555; text-indent:10px;width:200px; height:32px; border:1px solid #9a9a9a; line-height:32px; border-radius:4px; outline:none;\' value=\'\' placeholder=\'手机\'>");
document.writeln("						<textarea name=\'bd_bp_messText\' style=\'display:none;\'>请快速免费回电！</textarea>");
document.writeln("						<div style=\'clear:both;\'></div>");
document.writeln("					</div>");
document.writeln("				</div>");
document.writeln("				<div style=\'padding-top:10px; font-size:12px; color:red;display:none;\' align=\'center\' id=\'xs\'>我们将立即回电。该通话对您免费，请放心接听！</div>");
document.writeln("				<div style=\'padding-top:10px; padding-left:50px; padding-right:50px;\' align=\'center\'>");
document.writeln("					<button type=\'submit\' name=\'B1\' onclick=\'javascript:tjtj();\' style=\'float:left; width:90px; line-height:30px; height:30px; text-align:center; font-size:14px; color:#FFFFFF; border-radius:3px; background:#00c897; border:none; cursor:pointer;\' id=\'nb_nodeboard_send\'>提交留言</button>");
document.writeln("					<a href=\'javascript:void(0);\' onclick=\'online()\'>");
document.writeln("					<div style=\'float:right; width:90px; line-height:30px; text-align:center; font-size:14px; color:#FFFFFF; border-radius:3px;  background:#fea525;\' >在线咨询</div>");
document.writeln("					</a>");
document.writeln("					<div style=\'clear:both;\'></div>");
document.writeln("				</div>");
document.writeln("			</form>");
document.writeln("		</div>");
document.writeln("	</div>");
document.writeln("</div>");*/
var url;
url = window.location.host;
url = url.replace('http://','');
//ie placeholder 兼容
  if( !('placeholder' in document.createElement('input')) ){   

    $('input[placeholder],textarea[placeholder]').each(function(){    
      var that = $(this),    
      text= that.attr('placeholder');    
      if(that.val()===""){    
        that.val(text).addClass('placeholder');    
      }    
      that.focus(function(){    
        if(that.val()===text){    
          that.val("").removeClass('placeholder');    
        }    
      })    
      .blur(function(){    
        if(that.val()===""){    
          that.val(text).addClass('placeholder');    
        }    
      })    
      .closest('form').submit(function(){    
        if(that.val() === text){    
          that.val('');    
        }    
      });    
    });    
  }  