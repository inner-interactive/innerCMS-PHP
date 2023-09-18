jQuery(function($){

	var $userid = $('#userid');
	var $nickname = $('#nickname');
	var $realname = $('#realname');
	var $userpw = $('#userpw');
	var $userpw2 = $('#userpw2');
	var $email = $('#email');

	$('#idcheck').click(function(){
		var id = $userid.val();

		if(id != ""){
			$.ajax({ 
				  type: "POST", 
				  url: skinUrl + "idcheck.php", 
				  data: { "id" : id }

			}).done(function( msg ) { 
				  alert( msg ); 
			});


		}else{
			alert('아이디를 입력해주세요');
			$userid.focus();
		}

		return false;
	});


	$('#nicknamecheck').click(function(){
		var nickname = $nickname.val();

		if(nickname != ""){
			$.ajax({ 
				  type: "POST", 
				  url: skinUrl + "nicknamecheck.php", 
				  data: { "nickname" : nickname }

			}).done(function( msg ) { 
				  alert( msg ); 
			});

		}else{
			alert('닉네임을 입력해주세요');
			$nickname.focus()
		}

		return false;
	});

	
	
	$('#join_form').submit(function(){
		
		var userpw = $('#userpw').val();
		var userpw2 = $('#userpw2').val();
		var nickname = $('#nickname').val();
		var email = $('#email').val();
		
		if($userid.val() == ''){
			alert('아이디를 입력해 주십시오');
			$userid.focus();
			return false;
		}
		
		if($userpw.val() == ''){
			alert('비밀번호를 입력해 주십시오');
			$userpw.focus();
			return false;
		}
		
		if($userpw2.val() == ''){
			alert('비밀번호 확인을 입력해 주십시오');
			$userpw2.focus();
			return false;
		}
		
		if($realname.val() == ''){
			alert('실명을 입력해 주십시오');
			$realname.focus();
			return false;
		}
		
		if($nickname.val() == ''){
			alert('닉네임을 입력해 주십시오');
			$nickname.focus();
			return false;
		}
		
		if($email.val() == ''){
			alert('이메일을 입력해 주십시오');
			$email.focus();
			return false;
		}
		
		
		$(this).submit();
		
	});
	
	
	$('#zipsearch').click(function(){
		//form name, 우편번호, 기본주소, 상세주소, 참고항목, 주소타입
		win_zip('join_form', 'zipcode' , 'address', 'address2', 'address3', 'address_type', 2);
		return false;
	});
});