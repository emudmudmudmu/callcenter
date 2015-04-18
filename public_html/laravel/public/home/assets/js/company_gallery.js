jQuery(function($){
	$("#photo img").bind("load",function(){
		var ImgHeight = $(this).height();
		$('#photo').css('height',ImgHeight);
	});
	
	$('#thum-navi a').click(function(){
		if($(this).hasClass('over') == false){
			$('#thum-navi a').removeClass('over');
			$(this).addClass('over');
			$('#photo img').hide().attr('src',$(this).attr('href')).fadeIn();
		};
		return false;
	}).filter(':eq(0)').click();
});
