<!-- 최하단 윗글,아랫글 표시 -->
<div class="bottom_list">
	<?php if($preData != "" || $nextData != ""){?>
	<ul>
		<?php if($preData != ""){?>
		<li><a href="<?=getBackUrl("menu|mode|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;no=<?=$preData['indexcode']?>" title="윗글 <?=$preData['subject']?> 내용 보기"> <strong>▲ 윗글</strong> <?=$preData['subject']?></a></li>
		<?php }?>
		<?php if($nextData != ""){?>
		<li><a href="<?=getBackUrl("menu|mode|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;no=<?=$nextData['indexcode']?>" title="아랫글 <?=$nextData['subject']?> 내용 보기"> <strong>▼ 아랫글</strong> <?=$nextData['subject']?></a></li>
		<?php }?>
	</ul>
	<?php }?>
</div>
