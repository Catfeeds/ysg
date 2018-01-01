function setHome(obj, url){
	if(typeof setHomePage =='function')
	{
			setHomePage(obj,'../../../../index.htm'/*tpa=http://www.ysg.cn/*/);
			return
	}
	try {
		obj.style.behavior = 'url(#default#homepage)';
		obj.setHomePage(url);				
	} 
	catch (e) {			
		alert("您的浏览器不支持设为首页，请手动设置！");
	};	
}
function AddFavorite(sURL, sTitle) {
	try {
		window.external.addFavorite(sURL, sTitle)
	} catch(e) {
		try {
			window.sidebar.addPanel(sTitle, sURL, "")
		} catch(e) {
			alert("加入收藏失败，请使用Ctrl+D进行添加")
		}
	}
}
$(function () {
	$(".menu ul > li").hover(function () {
		$(this).addClass("xl")
	}, function () {
		$(this).removeClass("xl")
	})
	$('.menu_xl a:last').addClass('qline');
	$(".menu>.box1>ul>li:last-child").hide();
});

 
$(function(){
	$('.tab1').each(function(){
		
		$('.tab-hd1 > ul >li').hover(function(){
			$(this).addClass('dq').siblings().removeClass('dq');
			$('.tab-bd1 dl').eq($(this).index()).show().siblings().hide();
		}).eq(0).hover();
	});
	$('.in_news li:eq(0)').addClass('red');
	$('.in_news li:eq(1)').addClass('blue');
 });
 
