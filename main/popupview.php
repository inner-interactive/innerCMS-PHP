<?php
include "../common.php";
include "define.php";
include COMMON_PATH . "lib/common.lib.php";
include COMMON_PATH . "lib/db.class.php";
?>
<!doctype html>
<html lang="ko">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php

$no = intval($_GET['no']);

if ($no != 0) {

    $DB = new DB();

    // 팝업 게시물 가져오기
    $query = "SELECT * FROM " . POPUP_TABLE . " WHERE isstop = 0  AND pop_id = " . $no;
    $dbData = $DB->getDBData($query);
    $dbData[0]['memo'] = htmlspecialchars_decode($dbData[0]['memo']);
}

?>


<title><?=$dbData[0]['subject']?></title>

<link rel="stylesheet" type="text/css" href="jscss/common.css">
<style>
.not_today {
	width: 100%;
	height: 25px;
	background: #000;
	color: #fff;
	text-align: center;
}
</style>
<script src="../common/js/jquery-1.11.1.min.js"></script>
<script src="../common/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">


function popup_setCookie( name, value, expiredays )
{
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

jQuery(function($){
	
	$('#not_today').click(function(){
		ch = $(this).attr('checked');
		if(ch == "checked"){
			popup_setCookie( "Popup<?=$no?>", "done" , 1); // 1=하룻동안 공지창 열지 않음
			self.close(); 
		}
	});
});
	

</script>

</head>

<body>
<?=$dbData[0]['memo']?>
<? if($dbData[0]['not_today'] == 1){ ?>
<div class="not_today">
		<input type="checkbox" name="Popup<?=$no?>" id="not_today" value="1">
		<label for="not_today">오늘은 이창을 다시 열지 않음</label>
	</div>
<?}?>

</body>
</html>