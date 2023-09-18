jQuery(function($){
	
	$('#calendardiv').on('click', '.day-prev a, .day-next a', function(){
		
		no = $(this).data('no');
		date = $(this).data('date');
		
		$.get(skinUrl + 'getCaneldar.ajax.php?', { no: no, date: date }, function(data) {
			$('#calendardiv').html(data); 
		});
		return false;
	});
	
	
	
	
	
	//날짜 선택을 시작값으로 세팅
	function setStartTime(sel_date, sel_time, $el) {
		$("#date").val(sel_date);
		$("#stime").val(sel_time);
		$("#etime").val(sel_time);
		$('#time').val(sel_time);
		$('.day-time').removeClass('checked');
		$el.addClass('checked');
	}
	
	//시간대별 예약 신청하기 버튼 클릭시		
	$('.day-apply-btn.apply0').click(function(){
		if($("#date").val() == "" || $('#stime').val() == "" || $('#etime').val() == "") {
			alert('예약 하고자 하는 날짜와 시간을 선택해 주세요.');			
			return false;
		}
	});
	
	//시간대별 예약 신청시간 클릭시
	$('#calendardiv').on('click', '.timebox .day-time', function(){
		
		if(!$(this).hasClass('dayon')) return false;
		
		$date = $('#date');
		$stime = $('#stime');
		$etime = $('#etime');
		$time = $("#time");
		sel_date = $(this).data('date');
		sel_time = $(this).data('time');
		sel_index =$(this).index();
		max_count = parseInt($('#max_count').val());	//최대 사용시간 값
		
	
		
		//시간 선택이 처음인 경우 선택 날짜와 시간을 저장한다.
		if($date.val() == "" && $stime.val() == "" && $etime.val() == "") {
			
			setStartTime(sel_date, sel_time, $(this)); 
			
		}else{	//시간 선택이 처음이 아닐 경우
		
			
			if($date.val() == sel_date){ //기존에 선택된 날짜과 선택한 날짜가 같을 경우
					
				if($stime.val() == $etime.val()){	//시작 시간값과 종료시간값이 같을 경우(첫번째 클릭)
						
					//처음 선택된 시간을 찾는다.
					first_checked_index = $(this).closest('.dayboxw').find('.checked').index();
						
					if(first_checked_index >= sel_index){	//처음시간보다 같거나 이전 시간을 선택했다면 처음 날짜 선택값으로 초기화한다.
					
						setStartTime(sel_date, sel_time, $(this)); 
						
					}else{	 //이후 시간을 선택했다면 마지막 선택가능 시간까지 모두 선택 해주고 마지막 시간값을 저장함.
					
					
						$dayList = $(this).closest('.dayboxw').find('.day-time');	//선택된 날의 전체 시간 목록
						check_count = sel_index - first_checked_index + 1;	//선택된 시간 갯수
					
						
						start_index = first_checked_index;
						end_index = sel_index;
						if(check_count > max_count){	//최대 사용시간을 초과했다면
							end_index = first_checked_index + max_count - 1;
						//	alert('1일 최대사용시간은' + max_count + '시간입니다');
						}
							
						//선택된 날짜들 중에 선택 불가능한 시간이 있는지 체크한다.
						notUseTimeCount = 0;
						for(i = start_index; i <= end_index; i++){
							if(!$dayList.eq(i).hasClass('dayon')){
								notUseTimeCount++;
							}
						}
						
						
						if(notUseTimeCount == 0){
							timeList = [];
							for(i = start_index; i <= end_index; i++){
								$dayList.eq(i).addClass('checked');
								$etime.val($dayList.eq(i).data('time'));
								timeList.push($dayList.eq(i).data('time'));
							}
							
							if(timeList.length){
								$time.val(timeList.join("|"));
							}
	
						}else{		//선택된 날짜들 중에 선택 불가능한 시간이 있다면 마지막 시간을 시작시간으로 설정한다.
						
							setStartTime(sel_date, sel_time, $(this)); 
						}
						
					}
				}else{	//시작 시간값과 종료시간값이 다를 경우(이미 시작시간과 종료시간이 설정되고 나서 다시 클릭한 경우) 선택한 시간을 시작시간으로 설정한다.
					setStartTime(sel_date, sel_time, $(this)); 
				}
					
					
			}else{ //날짜가 다를 경우 선택한 시간을 시작시간으로 설정한다.
				setStartTime(sel_date, sel_time, $(this)); 
			}
			
			
			
		}
		

	});
	
	//오전/오후/야간별 예약 신청하기 버튼 클릭시
	$('.day-apply-btn.apply1').click(function(){
		if($("#date").val() == "" || ( $('#time1').val() == "" && $('#time2').val() == "" && $('#time3').val() == ""  ) ) {
			alert('예약 하고자 하는 날짜와 시간을 선택해 주세요.');			
			return false;
		}
	});


	

	
	
	//오전/오후/야간별 예약 시간 클릭시
	$('#calendardiv').on('click', '.divisionbox .day-time', function(){
		if(!$(this).hasClass('dayon')) return false;
		
		$date = $('#date');
		sel_date = $(this).data('date');
		sel_time = $(this).data('time');
		sel_type = $(this).data('type');
		
		//시간 선택이 처음일 경우
		if($date.val() == "") {
			$date.val(sel_date);
			$('#'+sel_type).val(sel_time);
			$(this).addClass('checked');
		}else{
			
			
			if($date.val() == sel_date){ //기존에 선택된 날짜과 선택한 날짜가 같을 경우
			
				//선택된 시간이면
				if($(this).hasClass('checked')){
					$('#'+sel_type).val('');
					$(this).removeClass('checked');
				}else{
					$('#'+sel_type).val(sel_time);
					$(this).addClass('checked');
				}
			
			}else{	//다른 날짜를 선택한 경우
				$date.val(sel_date);
				$('#time1, #time2, #time3').val('');
				$('.day-time').removeClass('checked');
				$('#'+sel_type).val(sel_time);
				$(this).addClass('checked');
			}
			
		}
	});
	
});