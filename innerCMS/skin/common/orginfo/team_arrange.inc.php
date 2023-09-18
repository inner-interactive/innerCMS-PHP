<form action="<?=SKIN_URL?>team_arrange.php" method="post">
	
	<div class="mb20 tleft">
		<input type="submit"" class="btn btn_apply" value="저장" />
		<?php if($teamCount > 1){?>
		<a href="<?=getBackUrl('menu')?>" class="btn btn-default">취소</a>
		<?php }?>
	</div>
	
	<?php 	
	if($teamCount > 0){
	?>
	<div id="team_arrange">
	    <div class="treeMenu">
	    <?php $orgInfo->getTeamList(0, 0, $no, 'arrange')?>
	    </div>
	</div>
	<?php 
	}?>


	<div class="mt20 tleft">
		<input type="submit"" class="btn btn_apply" value="저장" />
		<?php if($teamCount > 1){?>
		<a href="<?=getBackUrl('menu')?>" class="btn btn-default">취소</a>
		<?php }?>
	</div>
	
    <input type="hidden" name="menu" value="<?php echo $menuID?>" />
    <input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu', 1)?>" />
</form>