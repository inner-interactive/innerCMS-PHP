<?php 
$teamCount = $orgInfo->getTeamCount();
$action = isset($_GET['action']) ? trim($_GET['action']) : 'update';
?>
<div id="team_layer"<?php if($action == 'menu'){?> style="width:45%"<?php }?>>
	<?php include "team_".$action.".inc.php"?>
</div>

<?php 
if($no){
	$memCount = $orgInfo->getMemberCount($no);
?> 
<?php if($action == 'update'){?>	    	
<div id="member_layer">
	
    <div class="mem_func mb20">
		<a href="#" data-id="<?=$no?>" class="btn btn_apply member_write_open_btn">조직 구성원 등록</a>
		<?php if($memCount > 0){?>
		<a href="#" data-id="<?=$no?>" class="btn btn_apply member_arrange_open_btn">조직 구성원 순서정렬</a>
		<?php }?>
	</div>
				
	<div id="member_update">
		<form action="<?=SKIN_URL?>member_update.php" class="member_update_form" method="post">
		    	<?php $orgInfo->getMemberModifyList($no)?>
				<div class="mt20">
					<input type="submit" value="저장" class="btn btn_modify" />
				</div>
		    <input type="hidden" name="menu" value="<?php echo $menuID?>" />
		    <input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|no', 1)?>" />
		</form>
	</div>
	
	<?php if($memCount > 0){?>
	<div id="member_arrange">
		<form action="<?=SKIN_URL?>member_arrange.php" class="member_update_form" method="post">
			<?php $orgInfo->getMemberArrangeList($no)?>
			<div class="mt20 tcenter">
				<input type="submit" value="저장" class="btn btn_apply" />
				<a href="#" class="btn btn-default member_arrange_cancel_btn">취소</a>
			</div>
			<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		    <input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|no', 1)?>" />
		</form>
	</div>
	<?php }?>
	
	
</div>
<?php }else if($action == 'menu'){
$query = "SELECT menu_id FROM ".ORG_TABLE." WHERE org_id = ".$no;
$dbData = $DB->getDBData($query);
$selected_menu_id = intval($dbData[0]['menu_id']);
?>
<div id="member_layer" style="width:50%">
	<form action="<?=SKIN_URL?>team_menu.php" class="member_update_form" method="post">
	    	<table class="table_basic th-g">
			<caption><?=$orgInfo->getTeamNameAll($no);?></caption>
			<tbody>
					<tr>
					<th><label for="org_menu_id">메뉴선택</label></th>
					<td>
						<select name="menu_id" id="org_menu_id">
						<option value="0">선택</option>
						<?=$orgInfo->getMenuOption(ORG_MENUID, 2, 'main', $selected_menu_id)?>
						</select></td>
				</tr>
				</tbody>
		</table>
			<div class="mt20">
				<input type="submit" value="저장" class="btn btn_modify" />
			</div>
		<input type="hidden" name="no" value="<?=$no?>" />
	    <input type="hidden" name="menu" value="<?php echo $menuID?>" />
	    <input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|action|no', 1)?>" />
	</form>
</div>
<?php }?>

<?php 
}
?>


<?php 
include "form_team.inc.php";
include "form_member.inc.php";
?>
