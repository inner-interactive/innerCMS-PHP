jQuery(function($){
	$('#zipsearch').click(function(){
		//form name, 우편번호, 기본주소, 상세주소, 참고항목, 주소타입
		win_zip('fc_form', 'zipcode' , 'address', 'address2', 'address3', 'address_type');
		return false;
	});
	
	
		
	function showReservation(){
		
		reservation_use = $('input[name="reservation_use"]:checked').val();
		reservation_type = $('input[name="reservation_type"]:checked').val();
		reservation_type1_time_unit = $('input[name="reservation_type1_time_unit"]:checked').val();
		
		//예약 사용여부
		if(reservation_use == "1"){
			$('.reserv_use').show();
			
			//예약시간대방식
			if(reservation_type == '0'){
				$('.time_reserv').show();
				$('.division_reserv').hide();
				
				
				//예약시간단위
				if(reservation_type1_time_unit == '30M'){
					$('.time_m').show();
					$('.time_h').hide();
				}else if(reservation_type1_time_unit == '1H'){
					$('.time_m').hide();
					$('.time_h').show();
				}
				
			}else if(reservation_type == '1'){
				$('.time_reserv').hide();
				$('.division_reserv').show();
			}
			
			
		}else if(reservation_use == "0"){
			$('.reserv_use').hide();
		}
		
		
		
		
		
	}
	
	
	$('#reservation_use_Y, #reservation_use_N, #reservation_type1, #reservation_type2, #time_unit_M, #time_unit_H').click(function(){
		showReservation();
	});
	
	showReservation();
	
});