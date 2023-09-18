<div class="container">
<div class="complainBox">
	<div class="complainsBox">
		<div class="complainbox-title">
		<div class="complaintxt">
		<span><img src="img/comp.png"></span>이 페이지에 제공하는 정보에 대하여  만족도를 평가해 주세요. 여러분의 의견을 반영하는 재단이 되겠습니다.       
		</div>
		<div class="complaininput">
			<?php
            $satis = array(
                5 => '매우만족',
                4 => '만족',
                3 => '보통',
                2 => '불만족',
                1 => '매우불만족'
            );
            foreach ($satis as $key => $value) {
            ?>
			<span>
			 	<input type="radio" id="satis<?=$key?>" class="satisp" name="satisp" <?=$key == 5 ? "checked" : ""?> value="<?=$key?>" /> 
			    <label for="satis<?=$key?>"><?=$value?></label>			 
			</span>
		
			<?php }?>
		</div>
		
		
		</div>


	
		<div class="complaininputc">
			<input type="text" name="complain" id="complain" placeholder="의견을 입력해주세요." /> 
			<input type="button" class="btn" value="의견등록" id="btnSatisSubmit" />
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
//complain
jQuery(function($){

	$('#btnSatisSubmit').click(function(){

		/*
		if(userID == '')
		{
			alert('로그인이 필요합니다.');
			location.href = 'route.php?action=login&backUrl='+backUrl;
			return false;
		}
		*/
		
		point = $('input[name="satisp"]:checked').val();
		complain = $('#complain').val();
		if(point == '' || point == undefined){
			alert('평가항목을 선택해 주세요');
		}
		
		$.ajax({
			type : 'POST',
			data : {
				complain : complain,
				point : point,
				menu_id : menuID
			},
			dataType : 'json',
			url : 'complain_enroll_ajax.php',
			success : function(json){
				if(json.msg != "") alert(json.msg);
				if(!json.error) location.reload();
			}
		})
		
	});
});
</script>