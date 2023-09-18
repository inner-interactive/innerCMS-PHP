<?php if($grantValue['auth_admin']){?>
<select name="action" id="action">
	<option value="">기능선택</option>
	<option value="delhide">선택삭제</option>
	<option value="recover">선택복구</option>
	<option value="delreal">선택완전삭제</option>
	<option value="move">선택이동</option>
	<option value="copy">선택복사</option>
</select>
<select name="target_menu" id="target_menu">
	<option value="">메뉴선택</option>
	<?php foreach($system['data']['dbTableList'] as $tableData){?>
	<option value="<?=$tableData['menu_id']?>"><?=$tableData['menu_title']?></option>
	<?php }?>
</select>
<input class="btn btn-enter" type="submit" value="관리기능" title="관리기능" />
<input type="hidden" value="<?=$menuID?>" name="menu" />
<input type="hidden" value="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>" name="backUrl" />
<?php }?>