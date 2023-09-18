<?php if($SKIN->categoryUse){?>
<div class="categorySelect">
	<form action="categorylink.php" method="post">
		<fieldset>
			<legend>카테고리</legend>
			<select name="category" title="카테고리 옵션">
				<option value="">전체보기</option>
				<?php for($i = 0; $i < count($SKIN->categoryList); $i++){?>
				<option value="<?=$SKIN->categoryList[$i]?>" <?=isselected($SKIN->categoryList[$i], $category)?>><?=$SKIN->categoryList[$i]?></option>
				<?php }?>
			</select> 
			<input type="hidden" value="<?=getBackUrl("menu|mode|limit|sfv|".$_GET['sfv']."|opt")?>" name="backUrl" /> 
			<input type="submit" value="카테고리로 보기" title="선택한 카테고리로 보기" />
		</fieldset>
	</form>
</div>
<?php }?>
