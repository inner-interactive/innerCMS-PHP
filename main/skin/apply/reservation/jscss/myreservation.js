jQuery(function($){
	
	$('.cancel_reservation').click(function(){
		if(confirm('예약을 취소하시겠습니까?')){
			return true;
		}else {
			return false;
		}
	});
	
	
});