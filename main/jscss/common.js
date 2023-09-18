jQuery(function($){
	
	
	scroll = $(window).scrollTop();	
	function quickMenuDisplay(currentScroll){		
		if(currentScroll >= 300) {
			$('.quickmenu').fadeIn();
		}else{
			$('.quickmenu').fadeOut();
		}
	}		
	quickMenuDisplay(scroll);
	
	
	$('.quickmenu').click(function() {
		$('html, body').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
	
	
	
	
	function navBarFix(currentScroll)
	{
		//navbar fix
		if ($(window).scrollTop() > 290) {
			
			$('.header-nav-wrapper').addClass('navbar-fixed-top');
			$('.navbar-fixed-top h1 img').attr("src","img/logo-b.png"); 
			$('.navbar-fixed-top .searchAll img').attr("src","img/search-b.png"); 
			//$('.navbar-fixed-top .fmSitBt img').attr("src","img/familysite_bt_onb.png"); 
			$('.gnb-sub').css('position', 'fixed');	
			
			if ($(window).width() < 1024) {
			  $('.header-nav-wrapper').removeClass('navbar-fixed-top');
			  $('.gnb-sub').css('position', 'absolute');
			  	$('.header-nav-wrapper h1 img').attr("src","img/logo.gif"); 
				$('.searchAll img').attr("src","img/search-w.png"); 
			//    $('.fmSitBt img').attr("src","img/familysite_bt_onw.png"); 
			}
		}
		if ($(window).scrollTop() < 291) {
			$('.header-nav-wrapper').removeClass('navbar-fixed-top');
			$('.header-nav-wrapper h1 img').attr("src","img/logo.gif"); 
			$('.gnb-sub').css('position', 'absolute');
			$('.searchAll img').attr("src","img/search-w.png"); 
		    // $('.fmSitBt img').attr("src","img/familysite_bt_onw.png"); 
			
		}
	}
	
	navBarFix(scroll);
	
	$(window).scroll(function() {
		
		currentScroll = $(window).scrollTop();
		quickMenuDisplay(currentScroll);
		navBarFix(currentScroll);
		
	});
	
	
	
	

	// 통합검색
	$('.togglebar .search_open').click(function(){
		$('.search_wrap').show();
		$('#keyword').focus();
		return false;
	});
	
	$('.search_wrap .closeBtn>a').click(function(){
	
		$('.search_wrap').hide();
		return false;
	});
	
	$('#search_form').submit(function(){
		if($('#keyword').val() == "")
		{
			alert('검색어를 입력하세요.');
			$('#keyword').focus();
			return false;
		}
	});
	
	
	
	
	$('.topBb .tobanner').click(function(){
		has = $(this).hasClass('topon');
		if(has){
			topBannerOpen();
		}else{
			topBannerClose();
		}
	});
	

	
   
	//top banner slide
	var swiper = new Swiper('.swiper-container.topbannerw', {
		slidesPerView : 1,
		loop : true,
		loopFillGroupWithBlank : true,
		pagination : {
			el : '.swiper-pagination',
			clickable : true,
		},
	});
	
	
	
	
	$(".allMenu").css("height", $(window).height());
	if($(window).width() < 964){
		$(".allMenu").css("overflow-y","scroll");
	}
	$(".fmSitBt").click(function(){		
		TweenMax.to($(".allMenu"), 0.4, {width:"100%", display:"block", opacity:1, ease:Power3.easeOut});
		TweenMax.to($(".mainIndi"), 0.1, {opacity:0, ease:Power3.easeOut});
		if($(window).width() < 964){
			if(!$("#wrap").hasClass("main")){
				$("#wrap").css("overflow","hidden");
			}
		}
	});
	$(".allMenu .closeBtn").click(function(){
		TweenMax.to($(".mainIndi"), 0.1, {opacity:1, ease:Power3.easeOut});
		if($(window).width() < 964){
			TweenMax.to($(".allMenu"), 0.4, {display:"none", opacity:0, ease:Power3.easeOut, onComplete:function(){
				$(".allMenu ul li").removeClass("on");
				$(".allMenu ul li .twoD").stop(true.true).slideUp(0);
			}});
			if(!$("#wrap").hasClass("main")){
				$("#wrap").css("overflow","auto");
			}
		}else{
			TweenMax.to($(".allMenu"), 0.4, {display:"none", opacity:0, ease:Power3.easeOut});
		}
	});
	
	

	
});



