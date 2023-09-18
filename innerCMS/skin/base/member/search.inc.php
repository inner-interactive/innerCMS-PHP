<div class="searchbar">
	<form action="<?=BASE_SKIN_URL?>search.php" method="post" class="search">
		<fieldset>
			<legend>검색</legend>
			<span class="item"><label for="sv" class="labelhidden hide">검색어</label><input name="sv" type="text" id="sv" placeholder="검색어를 입력하세요" class="inputs" value="<?=$sv?>" /></span>
			<input type="hidden" value="<?=getBackUrl("menu|mode|category|limit|opt", 1)?>" name="backUrl" />
			<span class="btnSearch">
				<input type="submit" value="검색" title="검색" class="btn btn_apply" />
			</span>
		</fieldset>
	</form>
</div>