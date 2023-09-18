jQuery(function($){
	$('.pop_delete').click(function(){
		if(confirm('삭제한 팝업은 복구할 수 없습니다.\n팝업을 삭제하시겠습니까?'))
			return true;
		else
			return false;
	});
	
	$('#pop_type').change(function(){
		if($(this).val() == 'intro'){
			$('.popup_detail').hide();
		}else{
			$('.popup_detail').show();
		}
	});
});