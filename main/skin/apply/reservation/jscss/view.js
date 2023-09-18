jQuery(function($){
	
	if($('.view-img').find('.swiper-wrapper').length > 0){
		var swiper = new Swiper(".view-img", {
		  	navigation: {
	          nextEl: ".view-img .imgnext",
	          prevEl: ".view-img .imgprev",
	        },
		});
	}
	

    $("ul.tabs li").click(function () {
		index = $(this).index();
        $("ul.tabs li").removeClass("active");      
        $(this).addClass("active");

        $(".tab_content").hide();
		$('.tab_container').find('.tab_content').eq(index).fadeIn();
    });
    
	
	
	/*
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
	*/

});