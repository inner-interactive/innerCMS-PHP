jQuery(function($) {
	
	/* 상단 배너 */
	function topBannerOpen(){
		$('.topbanner').animate({height: 108}, 300);
		$('.topBb .tobanner').removeClass('topon');
		$('.topBb .tobanner').text('상단팝업닫기');
		
	}
	
	function topBannerClose(){
		$('.topbanner').animate({height: 0}, 300);
		$('.topBb .tobanner').addClass('topon');
		$('.topBb .tobanner').text('상단팝업열기');
	}
	
	$('.topbanner .closebtn').click(function(){	
		ch = $('#closet').attr('checked');
		if(ch == 'checked'){
			var todayDate = new Date();
			todayDate.setDate( todayDate.getDate() + 1 );
			document.cookie = "topbanner=" + escape( 'done' ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
		}
		
		topBannerClose();
		
	});
	
	var swiper = new Swiper('.swiper-container.topbannerw', {
		slidesPerView : 1,
		loop : true,
		loopFillGroupWithBlank : true,
		pagination : {
			el : '.swiper-pagination',
			clickable : true,
		},
	});
	
	
	
	/* 메인 텍스트 배너 */
	$('#maintext').slick({
		dots: true,
		infinite: true, 
		arrows:false,
		autoplay:true,
		autoplaySpeed: 8000
	});
	
	
	
	/* 배경 이미지 배너 */
	$('.Mainbg').on('init', function(event, slick){
		$(this).addClass("ani");
	}).slick({
		
		infinite: true,			
		speed: 1000,
		dots: true,
		arrows: true,
		autoplay: true,
		autoplaySpeed: 6000,
		fade: true,
		pauseOnHover: false,
		pauseOnFocus: false,
 		cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
		
		customPaging : function(slider, i) {
    		var title = $(slider.$slides[i]).data('title');
    		return '<button><em>'+title+'</em></button>';
		},
		responsive: [{
			 breakpoint: 768,
			 settings: {
					customPaging : function(slider, i) {
					var num = i+1;
					return '<button><em>0'+num+'</em></button>';
		     	}
			}
 		}]
	});
	
	
	
	/* D-day 배너 */
	$('#DDay').slick({
		infinite: true,
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  vertical : true,
		  autoplay: true,
		  autoplaySpeed: 3000,
		  arrows : false
	});
	
	$('#DDay').on('afterChange', function(event, slick, direction){
	  $('.d-daynum .ddayc').hide();
	  $('.d-daynum .ddayc').eq(direction).show();

	});
	
});