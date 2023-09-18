<div class="searchbar">
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

	<?php
    $option = array("subject|제목", "memo|내용", "uname|작성자");
    ?>
	<form action="searchlink.php" method="post" class="search">
		<fieldset>
			<legend>검색</legend>
			<select name="sf" title="검색 옵션">
				<? for($i = 0; $i < count($option); $i++){ $optionDiv = explode("|", $option[$i]);?>
				<option value="<?=$optionDiv[0]?>" <?=isselected($optionDiv[0], $_GET['sfv'])?>><?=$optionDiv[1]?></option>
				<?}?>
			</select> 
			<span class="item">
				<label for="sv" class="labelhidden">검색어</label>
				<input name="sv" type="text" id="sv" placeholder="검색어를 입력하세요" class="iText" value="<?=$_GET[$_GET['sfv']]?>" />
			</span> 
			<input type="hidden" value="<?=getBackUrl("menu|mode|category|limit|opt")?>" name="backUrl" /> 
			<span class="btnSearch"> <input type="image" src="img/skin/btnSearch.png" alt="검색" title="검색하기" /></span>
		</fieldset>
	</form>
</div>