jQuery(function($){
	
	//팀(부서) 등록 화면 오픈 버튼 클릭시
	$('.team_write_open_btn').click(function(){
		id = $(this).data('id');
		
		$('.team_write_layer').bPopup(function(){
			if(id != undefined){
				$('#org_parent').val(id);
			}else{
				$('#org_parent').val('');
			}
			$('#org_name').focus();
		});
		return false;
	});
	
	//팀(부서) 취소시
	$('.team_write_cancel_btn').click(function(){
		$('.team_write_layer').bPopup().close();
	});
	
	//팀(부서) 등록시 (폼 전송)
	$('.team_write_form').submit(function(){
		if($('#org_name').val() == ''){
			alert('팀(부서)명을 입력해 주세요');
			$('#org_name').focus();
				return false;
		}
	});
	
	
	
	//팀(부서) 수정 버튼 눌렀을 시
	$('.edit_btn').click(function(){
		$('.org_list').removeClass('edit');
		$(this).closest('li').addClass('edit');
		return false;
	});
	
	
	//팀(부서)명 수정 모드 취소시
	$('.edit_cancel').click(function(){
		$('.org_list').removeClass('edit');
		return false;
	});
	
	
	//팀(부서) 순서정렬 
		$('#team_arrange ul').sortable({
			cursor: "move"
		});
		
	
	// 조직 구성원 순서정렬 취소시
	$('.member_arrange_cancel_btn').click(function(){
		
		$('#arrange').sortable("cancel");
		$('#arrange').sortable("destroy");
		
		$('#member_update').fadeIn();
		$('.mem_func').show();
		$('#member_arrange').hide();
		return false;
		
	});
	
	
	
	//조직 구성원 등록 버튼 눌렀을 때
	$('#member_layer').on('click', '.member_write_open_btn', function(){
		id = $(this).data('id');
		
		$('.member_write_layer').bPopup(function(){
			if(id != undefined){
				$('#member_parent').val(id);
			}else{
				$('#member_parent').val('');
			}
			$('#name').focus();
		});
		return false;
	});
	
	
	//조직 구성원 등록 취소시
	$('.member_write_cancel_btn').click(function(){
		$('.member_write_layer').bPopup().close();
	});
	

	//조직 구성원 등록 폼 전송시
	$('.member_write_form').submit(function(){
		parent = $('#member_parent').val();
		if($('#name').val() == ''){
			alert('성명을 입력하세요');
			$('#name').focus();
			return false;
		}
		
	});
	
	//조직 구성원  순서정렬 버튼 클릭시
	$('.member_arrange_open_btn').click(function(){
		$('#arrange').sortable({
			cursor: "move"
		});
		$('#member_update').hide();
		$('.mem_func').hide();
		$('#member_arrange').fadeIn();
		return false;
		
	});
	
	// 조직 구성원 순서정렬 취소시
	$('.member_arrange_cancel_btn').click(function(){
		
		$('#arrange').sortable("cancel");
		$('#arrange').sortable("destroy");
		
		$('#member_update').fadeIn();
		$('.mem_func').show();
		$('#member_arrange').hide();
		return false;
		
	});
	
	
	
});
