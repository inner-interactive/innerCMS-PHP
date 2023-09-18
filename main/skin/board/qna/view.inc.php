<?php
$dbData = $system['data']['dbData'];
$fileData = $system['data']['fileData'];
$preData = $system['data']['preData'];
$nextData = $system['data']['nextData'];
?>
<!-- 본문 -->
<div id="form_view">

	<?php if($isAdmin){?>
	<form action="<?=SKIN_URL?>status_update.php" method="post"
		enctype="multipart/form-data">
		<div id="substance">
			<div class="check_list">
				<span><label for="status">처리상태</label></span> <select id="status"
					name="status">
					
					<?php for($i = 0;$i < count($statusList); $i++){?>
					<option value="<?=$statusList[$i]?>"
						<?=isselected($statusList[$i],$dbData[0]['f1'])?>><?=$statusList[$i]?></option>
					<?php }?>
				</select> <input type="submit" value="확인" /> <input type="hidden"
					name="backUrl"
					value="<?=getBackUrl("menu|pno|category|limit|no|sfv|opt", 1)?>&amp;mode=view" />
				<input type="hidden" name="menu" value="<?=$menuID?>" /> <input
					type="hidden" name="no" value="<?=$dbData[0]['indexcode']?>" />
			</div>
		</div>
	</form>
	<?php }?>

	<div class="page_view">
		<div class="titlebox">
			<h3 class="labelhidden">제목</h3>
			<div class="subject">
				<span><?=$dbData[0]['subject']?></span>

				<!-- 카테고리 시작 -->
				<?php if($SKIN->categoryUse){?>
				<span class="catetxt"><?=$dbData[0]['category']?></span>
				<?php }?>
				<!-- 카테고리 끝 -->

			</div>
			<div class="datestat">
				<ul>
					<?php $writetime  = isset($dbData[0]['replytime']) && $dbData[0]['replytime'] != "" ? trim($dbData[0]['replytime']) : trim($dbData[0]['writetime']);?>
					<li><?=substr($writetime, 0, 16)?></li>
					<li>조회 <?=intval($dbData[0]['view'])?></li>
				</ul>
			</div>
		</div>
		<!-- 본문 시작 -->
		<div class="substance">
			<h3 class="labelhidden">본문 내용</h3>
			<div class="smartOutput">
				<?=$dbData[0]['memo']?>
			</div>
		</div>
		<!-- 본문 끝 -->
		<div class="snsbtn">
			<a href="javascript:sendTwitter();"><img
				src="../common/img/sns/sns_twitter.gif" alt="트위터" /></a> <a
				href="javascript:sendFacebook();"><img
				src="../common/img/sns/sns_facebook.gif" alt="페이스북" /></a> <a
				href="javascript:sendGoogle();"><img
				src="../common/img/sns/sns_google.gif" alt="구글" /></a>
		</div>

		<?php include BASE_SKIN_PATH."file_download.inc.php"; ?>

		<script type="text/javascript">
		var sTitle = '<?=urlencode(html_entity_decode($dbData[0]["subject"]))?>';
		var sUrl = '<?=urlencode($full_url)?>';
		var pTitle = '<?=html_entity_decode($dbData[0]["subject"])?>';
		</script>
	</div>

	<?php include BASE_SKIN_PATH."comment.inc.php"; ?>

	<div class="btnbox">
		<!-- 버튼 및 기능모음 -->
		<div class="btn_basic1">
			<?php if($grantValue['auth_write']){?>
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write"
				title="글쓰기">글쓰기</a>
			<?php }?>
			
			<?php if($grantValue['auth_reply']){?>
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=reply">답글</a>
			<?php }?>
	
			<?php if($grantValue['auth_update'] && $dbData[0]['f1'] == $statusList[0]){?>
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;mode=update">수정</a>
			<?php if(intval($dbData[0]['delflag']) == 0 && $dbData[0]['f1'] == $statusList[0]){?>
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt|upw")?>&amp;mode=delete">삭제</a>
			<?}else{?>
			<?php if($grantValue['auth_admin']){?>
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|upw")?>&amp;mode=delete&amp;opt=2">완전삭제</a>
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|upw")?>&amp;mode=delete&amp;opt=1">복구</a>
			<?php }?>
			<?php }?>
			<?php }?>
		</div>

		<div class="btn_basic2">
			<a class="btn btn-default"
				href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
		</div>
	</div>

	<?php // include BASE_SKIN_PATH."prev_next_article.inc.php"; ?>
</div>
