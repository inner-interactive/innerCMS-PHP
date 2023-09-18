jQuery(function($){
	
	$('#indexnoAllCheck').click(function(){
		ch = $(this).attr('checked');
		if(ch){
			$('.indexno').attr('checked', 'checked');
		}else{
			$('.indexno').removeAttr('checked');
		}
	});
	
	
	if($('#action').val() == 'authlevel'){
		$('#authlevel').fadeIn();
	}else{
		$('#authlevel').fadeOut();
	}
	
	$('#action').change(function(){
		val = $(this).val();
		
		if(val == 'authlevel'){
			$('#authlevel').fadeIn();
		}else{
			$('#authlevel').fadeOut();
		}
	});
	
	$('.admin_form').submit(function(){
		
		action = $('#action').val();
		if(action == ''){
			alert('처리할 작업을 선택해 주세요');
			$('#action').focus();
			return false;
		}
		
		if(action == 'authlevel'){
			authlevel = $('#authlevel').val();
			
			if(authlevel == ''){
				alert('변경할 회원 권한을 선택해 주세요');
				return false;
			}
		}
		
		len = $('.indexno:checked').length;
		if(len == 0){
			alert('회원을 선택해 주세요.');
			return false;
		}
	});
});