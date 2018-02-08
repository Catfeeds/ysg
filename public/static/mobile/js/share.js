document.writeln("<style>");
document.writeln(".share_mask { position:fixed; top: 0; left: 0; width: 100%; height: 100%; background: #000; opacity: 0.8; display: none; }");
document.writeln(".share_dialog { width: 100%; background: #fff; position:fixed; bottom: 50px; left: 0;  display: none;}");
document.writeln(".share_dialog .share_tit { font-size: 16px; text-align: left; height: 44px; line-height: 44px; padding-left: 56px; }");
document.writeln(".share_dialog .share_cont li { height: 36px; line-height: 36px; font-size: 16px; color: #666; border-bottom: 1px solid #ededed; padding: 4px 0 4px 56px; text-align: left; }");
document.writeln(".share_dialog .share_cont li a { display: block; }");
document.writeln(".share_dialog .share_btn { font-size: 16px; width: 100%; text-align: center; height: 44px; line-height: 44px; color: #232323; background: #f7f7f7; cursor: pointer; border-top: 1px solid #DDD; margin-top: -1px; }");
document.writeln(".bdsharebuttonbox a.bds_weixin, .bdsharebuttonbox a.bds_qzone, .bdsharebuttonbox a.bds_sqq, .bdsharebuttonbox a.bds_tsina, .bdsharebuttonbox a.bds_copy { width: 100%; display: block; padding-left: 36px; }");
document.writeln("</style>");


document.writeln("<div class=\"share_mask\"></div>");
document.writeln("<div class=\"share_dialog\">");
document.writeln("  <div class=\"share_tit\">分享到</div>");
document.writeln("  <div class=\"share_cont bdsharebuttonbox\" data-tag=\"share_1\">");
document.writeln("    <ul>");
document.writeln("      <li><a class=\"bds_copy\" data-cmd=\"copy\">复制网址</a></li>");
document.writeln("      <li><a class=\"bds_qzone\" data-cmd=\"qzone\">QQ空间</a></li>");
document.writeln("      <li><a class=\"bds_sqq\" data-cmd=\"sqq\">QQ好友</a></li>");
document.writeln("      <li><a class=\"bds_tsina\" data-cmd=\"tsina\">微博</a></li>");
document.writeln("    </ul>");
document.writeln("  </div>");
document.writeln("  <div class=\"share_btn\">取消</div>");
document.writeln("</div>");

window._bd_share_config = {
		share : [{
			"bdSize" :24
		}],
	}
	//以下为js加载部分
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
	
	
    $(function(){
		
		$("#m_share").click(function(){
		$(".share_dialog").css({"display":"block","z-index":"3147483655"});
		$(".share_mask").css({"display":"block","height":"$(document).height()","z-index":"3147483650"});
	});
		
$(".share_btn").click(function(){
$(this).parents(".share_dialog").css({display:"none"});
$(".share_mask").css("display","none");});

		
		});	
