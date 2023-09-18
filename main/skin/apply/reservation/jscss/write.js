jQuery(function($){

	$('#zipsearch').click(function(){
		//form name, 우편번호, 기본주소, 상세주소, 참고항목, 주소타입
		win_zip('reservation_form', 'zipcode' , 'address', 'address2', 'address3', 'address_type', 2);
		return false;
	});

});