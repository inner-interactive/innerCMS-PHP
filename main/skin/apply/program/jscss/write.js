jQuery(function($){

	$('#domain').change(function(){
		
		$('#e_domain').val($(this).val());
		
		if($(this).val() != "")
			$('#e_domain').attr('readonly', true);
		else
			$('#e_domain').removeAttr('readonly');
		
		
	});
	

});