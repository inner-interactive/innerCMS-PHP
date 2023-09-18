<form action="<?=SKIN_URL?>team_update.php" method="post">

		<div class="mb20 tleft">
			<a href="<?=getBackUrl('menu')?>" class="btn btn-default">뒤로</a>
		</div>
		
		<?php 
		if($teamCount > 0){
		?>
		<div id="team_update">
		    <div class="treeMenu">
		    <?php $orgInfo->getTeamList(0, 0, $no, 'menu')?>
		    </div>
		</div>
		
		<div class="mt20 tleft">
			<a href="<?=getBackUrl('menu')?>" class="btn btn-default">뒤로</a>
		</div>
	
		<?php 
		}
		?>
		
	    <input type="hidden" name="menu" value="<?php echo $menuID?>" />
	    <input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu', 1)?>" />
</form>