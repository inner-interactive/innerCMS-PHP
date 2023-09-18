jQuery(function($){
	$(".calendar-box .con .event").click(function(){
		$('.carlender-pop').hide();
		$(this).parent().find(".carlender-pop").show();
		return false;
	});
	
	$(".carlender-pop .car-plist-title>.pop_close").click(function(){
		$('.carlender-pop').hide();
		return false;
	});
	
});