<?php 
$dbData = $system['data']['dbData'];
?>
<ul class="tabs">
<?php foreach($bannerConfig as $key => $value){?>
	<li<?=$type == $key ? " class=\"active\"" : ""?>><a href="<?=getBackUrl('menu|mode|pno')?>&type=<?=$key?>"><?=$value['title']?></a></li>
<?php }?>
</ul>

<form action="<?php echo SKIN_URL?>arrange.php" class="editor_form" method="post" enctype="multipart/form-data">
	<div class="helpbox">
		<p> - 드래그 하여 순서를 변경하실 수 있습니다.</p>
		<p> - 상단에 위치한 배너일수록 먼저 표시됩니다..</p>
	</div>
	<ul id="arrange" class="arrange">
		<?php foreach($dbData as $value){?>
		<li>
			<?php 
			if($type == 'backimage' || $type == 'top'){
				$thumbData = $SKIN->getFileData($menuID, $value['banner_id'], $type);
			?>
			<img src="../data/upload/<?=$thumbData[0]['attach_file_name']?>" style="max-width:800px" alt="" />
			<?php }else{?>
			<?=$value['title']?>
			<?php }?>
			<input type="hidden" name="indexno[]" value="<?=$value['banner_id']?>" />
		</li>
		<?php }?>
	</ul>
	
	
	
	<div class="function mt20" style="text-align:center">
		<input type="submit" value="저장" class="btn btn_apply" />
		<input type="hidden" name="menu" value="<?php echo $menuID?>" />
		<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|type', 1)?>" />
		<a href="<?php echo getBackUrl('menu|type')?>&mode=list" class="btn btn-default">뒤로</a>
	</div>
</form>

