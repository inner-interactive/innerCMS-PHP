jQuery(function($){
	
	$('#target_menu').hide();
	if($('#action').val() == 'copy' || $('#action').val() == 'move'){
		$('#target_menu').fadeIn();
	}else{
		$('#target_menu').fadeOut();
	}
	
	$('#action').change(function(){
		val = $(this).val();
		
		if(val == 'copy' || val == 'move'){
			$('#target_menu').fadeIn();
		}else{
			$('#target_menu').fadeOut();
		}
	});
	
		$('#indexnoAllCheck').click(function(){
		
		ch = $(this).is(":checked");
		if(ch){
			$('.indexno').attr('checked', 'checked');
		}else{
			$('.indexno').removeAttr('checked');
		}
	});
	
});