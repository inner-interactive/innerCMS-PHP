jQuery(function($){
	$('.banner_delete').click(function(){
		if(confirm('삭제한 배너는 복구할 수 없습니다.\n배너를 삭제하시겠습니까?'))
			return true;
		else
			return false;
	});
	
	
	$('#arrange').sortable({
		cursor: "move"
	});
	
});