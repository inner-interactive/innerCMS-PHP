jQuery(function($){
	
	$('.menu_delete').click(function(){
		if(confirm('메뉴를 삭제하시겠습니까?'))
			return true;
		else
			return false;
	});
	
	
	
	
	//메뉴 검색
	$("#menuSearch").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#menuTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
		
		var todayDate = new Date();
		todayDate.setDate( todayDate.getDate() + 1 );
		document.cookie = "menukeyword=" + ( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	});
	
	$("#menuSearch").keyup();
	
	
	
	
	//메뉴 타이틀 클릭시
	$('.title_output').click(function(){
		$(this).hide();
		$(this).next('.title_input').show().focus();
	});
	
	//메뉴 타이틀 변경
	$('.title_input').blur(function(){
		title = $(this).val();
		no = $(this).data('no');
		
		$(this).hide();
		$(this).prev('.title_output').text(title).show();
		
		$.ajax({
			type : "post",
			url : skinUrl + 'quickUpdateAjax.php',
			data : {
				no : no,
				action : 'menu_title',
				value : title
			}
		});
	});
	
	
	//스킨명 클릭시
	$('.skin_output').click(function(){
		$(this).hide();
		$(this).next('.skin_input').show().focus();
	});
	
		
	//스킨 변경
	$('.skin_input').blur(function(){
		
		skin = $(this).val();
		no = $(this).data('no');
		
		$(this).hide();
		$(this).prev('.skin_output').text(skin).show();
		
		$.ajax({
			type : "post",
			url : skinUrl + 'quickUpdateAjax.php',
			data : {
				no : no,
				action :'skin_change',
				value : skin
			}
		});
	});
	
	
	
	//페이지바디 클릭시
	$('.body_output').click(function(){
		$(this).hide();
		$(this).next('.body_input').show().focus();
	});
	
		
	//페이지 바디 변경
	$('.body_input').blur(function(){
		
		file = $(this).val();
		no = $(this).data('no');
		
		$(this).hide();
		$(this).prev('.body_output').text(file).show();
		
		$.ajax({
			type : "post",
			url : skinUrl + 'quickUpdateAjax.php',
			data : {
				no : no,
				action :'body_change',
				value : file
			}
		});
	});
	
	
	//메뉴 새창
	$('.quick_target').click(function(){
		
		if(!confirm('메뉴새창 여부를 변경하시겠습니까?')){
			return false;
		}
		
		no = $(this).data('no');
		text = $(this).text();
		if(text == '현재창'){
			target = 'B';
			$(this).text('새창');
		}else if(text == '새창'){
			target = 'S';
			$(this).text('현재창');
		}
		
		$.ajax({
			type : "post",
			url : skinUrl + 'quickUpdateAjax.php',
			data : {
				no : no,
				action :'target_change',
				value : target
			}
		});
		
		return false;
	});
	
	
	//메뉴 숨김
	$('.quick_hide').click(function(){
		if(!confirm('메뉴숨김 상태를 변경하시겠습니까?'))
			return false;
		
		no = $(this).data('no');
		num = $(this).data('column');
		
		
		text = $(this).text();
		if(text == '숨김'){
			hide = 0;
			$(this).text('노출');
		}else if(text == '노출'){
			hide = 1;
			$(this).text('숨김');
		}
		
		$.ajax({
			type : "post",
			url : skinUrl + 'quickUpdateAjax.php',
			data : {
				no : no,
				action :'menu_hide',
				value : hide,
				num : num
			}
		});
		
		return false;
		
	});
	
});