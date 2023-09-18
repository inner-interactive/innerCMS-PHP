<?php
$dbData = $system['data']['dbData'];
$fileData = $system['data']['fileData'];
$preData = $system['data']['preData'];
$nextData = $system['data']['nextData'];
?>
<!-- 본문 -->
<div id="form_view">

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
			<div class="subjectinfo">
				<ul>
					<li><strong>기간</strong><?=$dbData[0]['date1']?> ~ <?=$dbData[0]['date2']?></li>
					<li><strong>장소</strong><?=$dbData[0]['f1']?></li>
				</ul>
			</div>
			<div class="subjectinfo">
				<ul>
					<li><strong>주최</strong><?=$dbData[0]['f2']?></li>
					<li><strong>주관</strong><?=$dbData[0]['f3']?></li>
				</ul>
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


	<?php include BASE_SKIN_PATH."comment.inc.php"; ?>
	<?php include BASE_SKIN_PATH."view_btn.inc.php"; ?>
	<?php include BASE_SKIN_PATH."prev_next_article.inc.php"; ?>

</div>