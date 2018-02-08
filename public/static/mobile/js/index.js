// JavaScript Document


$(function(){
	var nrW = $('.content2').width();
	$('.content2 img').each(function(){
	if($(this).width() > nrW)
		$(this).css('width',nrW);
		$(this).css('height','auto');
	})
});




		

$(function(){
	
	$(".opennav").click(function(){
		
			$('.h_nav').slideToggle(400);

	  });
	
	
	
	
});
$(document).bind("click",function(e){
		var target  = $(e.target);
		if(target.closest(".opennav,.h_nav").length == 0){
			$(".h_nav").slideUp(400);
			
		};
		e.stopPropagation();
	})
		
		

$(function(){
		$('.qh_hd ul li').click(function(){
			$(this).addClass('current').siblings().removeClass('current');
			$(this).parents('.qh_hd').next().children('ul').eq($(this).index()).show().siblings().hide();
		}).eq(0)[sEvent]();
	
});
 

