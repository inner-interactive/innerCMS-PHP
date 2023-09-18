<form action="<?php echo SKIN_URL?>arrange.php" class="editor_form" method="post">

	<div class="function mb20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply arrange_apply" />
		<a href="<?php echo getBackUrl('menu|site|pagetype')?>&mode=list" class="btn btn-default">뒤로</a>
	</div>
	<div class="mb10">
		<p>-드래그 앤 드롭으로 순서를 정렬할 수 있습니다.</p>
		<p>-정렬이 완료된 후 저장버튼을 누르시면 됩니다.</p>
	</div>
	
	<div id="menu_arrange" class="treeMenu">
	<?php $menuInfo->getArrangeList(0, 1)?>
	</div>
	
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply arrange_apply" />
		<a href="<?php echo getBackUrl('menu|site|pagetype')?>&mode=list" class="btn btn-default">뒤로</a>
	</div>
	
	<input type="hidden" name="site" value="<?php echo $siteKey?>" />
	<input type="hidden" id="arrangeText" name="arrangeText" value="" />
	<input type="hidden" name="menu" value="<?php echo $menuID?>" />
	<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|site|pagetype', 1)."&mode=list"?>" />
	
</form>


<script>


</script>