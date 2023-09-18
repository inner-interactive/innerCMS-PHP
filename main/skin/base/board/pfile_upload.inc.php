<div class="thume">
	<?php  if($grantValue['auth_fileup']){?>
	<div class="insert">
		<ul>
			<li><input class="upload-name" disabled="disabled" /> <label for="pfile">섬네일파일<?=$SKIN->thumbnailWidth && $SKIN->thumbnailHeight ? "(".$SKIN->thumbnailWidth."*".$SKIN->thumbnailHeight.")" : ""?></label><input class="upload-hidden" type="file" name="pfile" id="pfile" /></li>
			<?php for($i = 1 ; $i <= 10; $i++){?>
			<li><input class="upload-name" disabled="disabled" /> <label for="sfile<?=$i?>">첨부파일<?=$i?></label><input class="upload-hidden" type="file" name="sfile[]" id="sfile<?=$i?>" /></li>
			<?php }?>
		</ul>
	</div>
	<p class="guide">* 최대 첨부파일 용량은 <?=$SKIN->limitFileSizeTxt?> 입니다. 제한 용량을 초과하는 파일은 제외됩니다.</p>
	<?php }?>
</div>