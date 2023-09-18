jQuery(function(){
	
	  $(".tfixmenu > ul > li > a").hover(function(){	
   $(".tfixnavSub").hide();
    $(this).next().show();
  });
  
 $(".tfixmenu").bind('mouseleave', function () {
	 $('.tfixnavSub').hide();
   });
   
   //gnb
   $(".header .gnb-area > ul > li > a").hover(function(){	
    $(".gnb-area .navSub").hide();
 
    $(this).next().show();
  });
  
   $(".gnb-area .navSub > ul > li > a").hover(function(){	
     $('.gnb-area .navSub > ul > li > ul').hide();
  
  });

 $(".gnb-area .navSub").bind('mouseleave', function () {
	 $('.gnb-area .navSub').hide();
   }); 
   
    $(".gnb-area .gnb").bind('mouseleave', function () {
	 $('.navSub').hide();
   }); 
   
    $(".gnb-area .navSub > ul > li > a.depth").hover(function(){	
	   $('.gnb-area .navSub > ul > li > ul').hide();
		$(this).next().show();
	  });
	  
	  
   $(".allMenuw .navSub > ul > li > a.depth").click(function(){	
   $('.allMenuw .navSub > ul > li > ul').hide();
	$(this).next().show();
  });
	  
	  $(".allMenuw .navSub").bind('mouseleave', function () {
	   $('.allMenuw .navSub').show();
     }); 
   
     $(".allMenuw .gnb").bind('mouseleave', function () {
	   $('.allMenuw .navSub').show();
     }); 
	 
	 
	  
	   $(".allMenuw .navSub > ul > li > a.depth").click(function(){	
	   $('.allMenuw .navSub > ul > li > ul').hide();
		$(this).next().show();
		  return false;
	  });
	
	
	$(window).resize(function(){
		var width = $(window).width();
		if(width < 1024)
		{
		 $('.gnb-sub').hide();
		}
	});
	
	
	
	//모바일 메뉴
	var node = new Object();
	var method = new Object();
	var val = new Object();

	node.hamburger = $("a.hamburger");
	node.hamburgerClose = $("#hamburger").find("a.close");

	method.HamburgerEvent = function(e) {
		var html = $("html");
		var target = $("#hamburger");
		var blackShadow = $(".black_shadow");
		if (!html.hasClass("active")) {
			target.show();
			blackShadow.show();
			html.addClass("active");
		} else {
			target.hide();
			blackShadow.hide();
			html.removeClass("active");
		}
		return false;
	}

	method.windowResizeEvent = function(e) {
		var html = $("html");
		var target = $("#hamburger");
		var blackShadow = $(".black_shadow");
		var width = $(this).width();
		var limitX = 980;
		if (width > limitX) {
			html.removeClass("active");
			target.hide();
			blackShadow.hide();
		}
	}

	node.hamburger.on("click", method.HamburgerEvent);
	node.hamburgerClose.on("click", method.HamburgerEvent)
	$(window).on("resize", method.windowResizeEvent);
	
	$('#hamburger a.close').click(function(){
		$('.header>.mmain-top').show();
	});
	
	$('.mmain-top .hamburger').click(function(){
		$('.header>.mmain-top').hide();
	});
	
	$('ul.mtree').mtree({
		collapsed: true, // Start with collapsed menu (only level 1 items visible)
  		close_same_level: true, // Close elements on same level when opening new node.
		duration: 300, // Animation duration should be tweaked according to easing.
		listAnim: true, // Animate separate list items on open/close element (velocity.js only).
		easing: 'easeOutQuart', // Velocity.js only, defaults to 'swing' with jquery animation.
	});
	
	
	
	//서브페이지 1차, 2차, 3차 메뉴 열기/닫기
	$("#lnb .lnb_n").click(function() {
		$('#lnb .lnb_list').slideUp();
		$('#lnb .lnb_area').removeClass('active');
		if($(this).next(".lnb_list").css('display') != "block")
		{
			$(this).next(".lnb_list").slideDown();
			$(this).parents(".lnb_area").toggleClass("active");
		}
		
		return false;
	});	
	
});