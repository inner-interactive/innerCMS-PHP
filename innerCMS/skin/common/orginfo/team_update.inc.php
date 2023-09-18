<form action="<?=SKIN_URL?>team_update.php" method="post">

		<div class="mb20 tleft">
			<a href="#" class="btn btn_apply team_write_open_btn">최상위 팀(부서) 등록</a>
			<?php if($teamCount > 1){?>
			<a href="<?=getBackUrl('menu')?>&action=arrange" class="btn btn_apply">팀(부서) 순서 정렬</a>
			<!-- <a href="<?=getBackUrl('menu')?>&action=menu" class="btn btn_apply">메뉴 연동</a> -->
			<?php }?>
		</div>
		
		<?php 
		if($teamCount > 0){
		?>
		<div id="team_update">
		    <div class="treeMenu">
		    <?php $orgInfo->getTeamList(0, 0, $no)?>
		    </div>
		</div>
		
		<div class="mt20 tleft">
			<a href="#" class="btn btn_apply team_write_open_btn">최상위 팀(부서) 등록</a>
			<?php if($teamCount > 1){?>
			<a href="<?=getBackUrl('menu')?>&action=arrange" class="btn btn_apply">팀(부서) 순서 정렬</a>
			<!-- <a href="<?=getBackUrl('menu')?>&action=menu" class="btn btn_apply">메뉴 연동</a> -->
			<?php }?>
		</div>
	
		<?php 
		}
		?>
		
	    <input type="hidden" name="menu" value="<?php echo $menuID?>" />
	    <input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu', 1)?>" />
</form>