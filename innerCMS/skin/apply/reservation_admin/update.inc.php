<form action="<?php echo SKIN_URL?>update.php" name="fc_form" class="editor_form" method="post" enctype="multipart/form-data">
	
	<?php
	$dbData = $system['data']['dbData'];
	$thumbData = $system['data']['thumbData'];
	$picData = $system['data']['picData'];
	$files1Data = $system['data']['files1Data'];
	$files2Data = $system['data']['files2Data'];
	
	if($fmode == 'facility'){
    	include "form.facility.inc.php";
	}else if($fmode == 'reservation'){
    	include "form.reservation.inc.php";
	}
	?>
		
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="fmode" value="<?=$fmode?>" />
		<input type="hidden" name="no" value="<?php echo intval($_GET['no'])?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|no|sno|pno', 1)."&mode=view"?>" />
		<a href="<?php echo getBackUrl('menu|no|sno|pno')?>&mode=view" class="btn btn-default">뒤로</a>
	</div>
</form>