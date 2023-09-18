jQuery(function(){
	$('.leftnav-title').click(function(){
		
		$(this).toggleClass('pluson');
		$(this).next('.moremenu').slideToggle();
		return false;
	});
});