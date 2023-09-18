jQuery(function($){
	$('.set_delete').click(function(){
		if(confirm('현재 메뉴의 설정값을 삭제하시겠습니까?'))
		{
			return true;
		}else
		{
			return false;
		}
	});
	
	$('.apply_delete').click(function(){
		if(confirm('삭제한 데이터는 복구할 수 없습니다.\n신청내역을 삭제하시겠습니까?'))
		{
			return true;
		}else
		{
			return false;
		}
	});
	
	$('.fc_delete').click(function(){
		if(confirm('예약시설을 삭제하면 모든 첨부파일과 예약신청정보가 삭제됩니다.\n삭제한 데이터는 복구할 수 없습니다.\n계속하시겠습니까?'))
		{
			return true;
		}else
		{
			return false;
		}
	});
	
	$('.delfile').click(function(){
		if(confirm('삭제한 파일은 복구할 수 없습니다.\n삭제하시겠습니까?'))
		{
			return true;
		}else
		{
			return false;
		}
	});
	
	$('.apply_change').click(function(){
		name = $(this).data('name');
		status = $(this).data('status');
		msg = null;
		if(status == '미승인'){
			msg = name + '님의 신청상태를 미승인 처리하시겠습니까?';
		}else if(status == '승인'){
			msg = name + '님의 신청상태를 승인 처리하시겠습니까?';
		}
		
		if(confirm(msg))
		{
			return true;
		}else
		{
			return false;
		}
	});
	
	
	$('#ptype1').click(function(){
		$('#date1, #date2').removeAttr('disabled');
		$('#ptext').attr('disabled', true);
	});
	
	$('#ptype2').click(function(){
		$('#ptext').removeAttr('disabled');
		$('#date1, #date2').attr('disabled', true);
	});
	
});