<?php if($isAdmin){?>
<select name="action" id="action" style="height:42px">
	<option value="">기능선택</option>
	<option value="authlevel">회원권한변경</option>
	<option value="blacklist">블랙리스트등록</option>
	<option value="retire">회원탈퇴처리(복구불가능)</option>
	<option value="delete">회원완전삭제(복구불가능)</option>
</select>
<select name="authlevel" id="authlevel" style="display:none">
	<option value="">권한선택</option>
	<?php foreach($groupList as $value){?>
	<option value="<?=$value['authlevel']?>"><?=$value['name']?></option>
	<?php }?>
</select>
<input class="btn btn-enter" type="submit" value="관리기능" title="관리기능" />
<input type="hidden" value="<?=$menuID?>" name="menu" />
<input type="hidden" value="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt", 1)?>" name="backUrl" />
<?php }?>