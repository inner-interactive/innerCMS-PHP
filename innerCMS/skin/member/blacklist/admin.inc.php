<?php if($isAdmin){?>
<select name="action" id="action">
	<option value="">기능선택</option>
	<option value="noblacklist">블랙리스트 제한해제</option>
	<option value="retire">회원탈퇴처리(복구불가능)</option>
	<option value="delete">회원완전삭제(복구불가능)</option>
</select>
<input class="btn btn-enter" type="submit" value="관리기능" title="관리기능" />
<input type="hidden" value="<?=$menuID?>" name="menu" />
<input type="hidden" value="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt", 1)?>" name="backUrl" />
<?php }?>