jQuery(function($){
	
	$('.delete_complain').click(function(){
		if(confirm('삭제된 의견은 복구할 수 없습니다.\n삭제하시겠습니까?'))
			return true;
		else
			return false;
	});
	
	$('#site').change(function(){
		val = $(this).val();
		$('#site_form').submit();
	});
});