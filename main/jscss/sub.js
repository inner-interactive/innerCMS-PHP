

jQuery(function($) {
	
	$(".tabm .subtabmenu .tabs li a").click(function () {
		$(".tabm .subtabmenu .tabs li a").removeClass("activeon");     		
		$(this).addClass("activeon");
		$(this).parent().parent().parent().find(".tab_content").hide()
		var activeTab = $(this).attr("data-rel");
		$("#" + activeTab).fadeIn();
	});	
	
	//sns open & close
	$(".btn-b1").mouseover(function() {
		$(".hiddenover").show(10);
		$(this).addClass('on');
	});

	$(".hiddenoverw").mouseleave(function() {
		$(".hiddenover").hide(10);
		$('.on').removeClass('on');
	});

	
	$(".black_shadow").click(function() {
		$("#hamburger").hide();
		$(this).hide();
	})
	
		
	//sns open & close
	$(".mserchico").mouseover(function() {
		$('.mserchico img').attr("src","img/inc/searchwb.png"); 
	});
	$(".mserchico").mouseout(function() {
		$('.mserchico img').attr("src","img/inc/searchw.png"); 
	});

	$('.send_twitter').click(function(){
		sendTwitterList(headTitle, fullUrl);
	});
	
	$('.send_facebook').click(function(){
		sendFacebookList(headTitle, fullUrl);
	});
	
	$('.send_google').click(function(){
		sendGoogleList(headTitle, fullUrl);
	});

	//URL 복사
	$('.copy_clip').click(function(){
		copy_to_clipboard(location.href);
	});
			
	//프린트
	$('.print_page').click(function(){
		window.print(); 
		return false;
	});

	
	
});


function is_ie() {
	if(navigator.userAgent.toLowerCase().indexOf("chrome") != -1) return false;
	if(navigator.userAgent.toLowerCase().indexOf("msie") != -1) return true;
	if(navigator.userAgent.toLowerCase().indexOf("windows nt") != -1) return true;
	return false;
}


function copy_to_clipboard(str) {
	if( is_ie() ) {
	  window.clipboardData.setData("Text", str);
	}else {
		  var t = document.createElement("textarea");
		  document.body.appendChild(t);
		  t.value = str;
		  t.select();
		  document.execCommand('copy');
		  document.body.removeChild(t);
		  
	}
	alert("복사되었습니다.");
}


function sendTwitterList(sTitle, sUrl){
	var shref ='http://twitter.com/home?status='+sTitle+' '+sUrl;
	var sWindow=window.open(shref,'','width=1024, height=800');
	if (sWindow){
		sWindow.focus();
	}
}

function sendFacebookList(sTitle, sUrl){	
	var shref ='http://www.facebook.com/sharer.php?u='+sUrl+'&t='+sTitle;
	var sWindow=window.open(shref,'sharer','toolbar=0,status=0,width=640,height=500');
	if (sWindow){
		sWindow.focus();
	}
}

function sendGoogleList(sTitle, sUrl){	
	var shref = 'http://www.google.com/bookmarks/mark?op=add&title='+sTitle+'&bkmk='+sUrl;
	var sWindow=window.open(shref,'','menubar=no, toolbar=no, location=no, scrollbars=no, width=1024, height=800');
	if (sWindow){
	sWindow.focus();
	}
}

