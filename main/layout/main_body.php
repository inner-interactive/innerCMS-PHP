<?php
$where = " WHERE delflag = 0 AND iscomment = 0";
$orderby = " ORDER BY isimportant DESC, writetime DESC";
?>

<?php include "banner/backimage.inc.php"?>
<div class="maintop">
	<div class="mainimg">
	
		<?php include "banner/maintext.inc.php"?>
		
		<div class="tfixmenu">
			<ul>
				<li><a href="#">원서접수</a></li>
				<li><a href="#">수험표출력</a></li>
				<li><a href="#">경쟁률</a></li>
				<li><a href="#">합격조회</a></li>
				<li><a href="#"> 납부조회</a></li>
				<li><a href="#">서류제출여부 확인</a></li>
			</ul>
		</div>
	</div>
</div>