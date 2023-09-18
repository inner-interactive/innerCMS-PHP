jQuery(function($){
	$('.delete').click(function(){
		if(confirm('삭제한 데이터는 복구할 수 없습니다.\n삭제하시겠습니까?'))
			return true;
		else
			return false;
	});
	
});