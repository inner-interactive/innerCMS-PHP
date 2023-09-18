jQuery(function($){
	
	
	$("#edu_slide").after('<ul class="edu_pager">').cycle({
		fx : 'fade',
		pager : $('.edu_pager'),
		pagerAnchorBuilder : function(index, slide){
			return '<li><a href="#"><img src="' + slide.children[0].getAttribute('src') + '" /></a></li>'; 
		}
	});
	
	
	$('#edu_slide a')
	.fancybox({
		padding : 10,
		imageScale : false,
		overlayShow : true,
		overlayOpacity : 0.9,
		cyclic : true,
		transitionIn : 'fade',	//elastic, fade, none
		transitionOut : 'fade',	//elastic, fade, none
		speedIn : 500,
		speedOut : 500,
		zoomOpacity : true,
		titleShow : false,
		titlePosition : 'over'		// outside, inside, over
	});
	

});