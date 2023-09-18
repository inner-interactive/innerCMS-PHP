<div class="btnbox">
	<!-- 버튼 및 기능모음 -->
	<div class="btn_basic1">
		<?php if($grantValue['auth_write']){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write" title="글쓰기">글쓰기</a>
		<?php }?>
		
		<?php if($grantValue['auth_reply']){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=reply">답글</a>
		<?php }?>

		<?php if($grantValue['auth_update']){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;mode=update">수정</a>
		<?php if(intval($dbData[0]['delflag'])==0){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;mode=delete">삭제</a>
		<?}else{?>
		<?php if($grantValue['auth_admin']){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|upw")?>&amp;mode=delete&amp;opt=2">완전삭제</a>
		<a class="btn btn-default" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|upw")?>&amp;mode=delete&amp;opt=1">복구</a>
		<?php }?>
		<?php }?>
		<?php }?>
	</div>

	<div class="btn_basic2">
		<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
		<?php if($preData != ""){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|mode|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;no=<?=$preData['indexcode']?>" title="윗글 <?=$preData['subject']?> 내용 보기">▲윗글</a>
		<?php }?>

		<?php if($nextData != ""){?>
		<a class="btn btn-default" href="<?=getBackUrl("menu|mode|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;no=<?=$nextData['indexcode']?>" title="아랫글 <?=$nextData['subject']?> 내용 보기">▼아랫글</a>
		<?php }?>
	</div>
</div>