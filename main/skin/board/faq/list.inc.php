<?php include BASE_SKIN_PATH."category_search.inc.php"; ?>

	<?php if($grantValue['auth_admin']){?>
<form action="admin.php" method="post" enctype="multipart/form-data">
	<?php }?>

		<div class="faq">

		<div class="hgroup">
			<span class="etctextbg"> <a href="#openAll" class="trigger faqopen"
				title="답변 모두 여닫기">답변 모두 여닫기</a>
			</span>
				<?php if($grantValue['auth_admin']){?><input type="checkbox"
				name="indexnoTop" id="indexnoAllCheck" /><label
				for="indexnoAllCheck">전체 목록 선택</label><?php }?>
			</div>
		<ul>
			<?php
$dbData = $system['data']['dbData'];
for ($i = 0; $i < count($dbData); $i ++) {
    $del_in = intval($dbData[$i]['delflag']) == 1 ? "<del>" : "";
    $del_out = intval($dbData[$i]['delflag']) == 1 ? "</del>" : "";
    $writetime = $dbData[$i]['replytime'] == "" ? $dbData[$i]['writetime'] : $dbData[$i]['replytime'];
    ?>
				<li class="article faqhide">
				<div class="q">
					<a class="trigger" href="#open"
						title="<?=$dbData[$i]['subject']?> 내용 보기"> <span class="qfaq">Q</span>
						<!-- 카테고리 시작 -->
							<?php if($SKIN->categoryUse){?>
							<span class="catetxt"><?=$dbData[$i]['category']?></span>
							<?php }?>
							<!-- 카테고리 끝 -->
							<?php if($grantValue['auth_admin']){?><input type="checkbox"
						class="indexno" name="indexno[]"
						value="<?=$dbData[$i]['indexcode']?>" /><?php }?>
							<?php if($dbData[$i]['isimportant']==1){?><img
						src="img/skin/important.gif" alt="공지글" /><?php }?>
							<?php if($dbData[$i]['replytime'] != ""){  for($k = 0; $k < intval($dbData[$i]['replyrank']); $k++){?>&nbsp;&nbsp;<?php }?><img
						src="img/skin/re.gif" alt="답변글" /><?php }?>
							<?php if($dbData[$i]['issecret'] == 1){?><img
						src="img/skin/secret.gif" alt="비밀글" /><?php }?>
							<span><?=$del_in.strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum).$del_out?></span>
							<?php if(isNew($writetime)){?><img src="img/skin/new.gif"
						alt="최신글" /><?php }?>
						</a>
						<?php if($grantValue['auth_admin']){?>
						<a
						href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=view&amp;no=<?=$dbData[$i]['indexcode']?>"
						class="viewadmin" title="<?=$dbData[$i]['subject']?> 내용 보기">관리자 보기</a>
						<?php }?>
					</div>

				<div class="a">
					<div><?=$dbData[$i]['memo']?></div>
				</div>
			</li>
				<?php }?>
				<?php if(count($dbData)==0){?>
				<li class="article faqhide">
				<p class="q">
					<a class="trigger" href="#open"><img src="img/skin/q.gif"
						width="18" height="18" border="0" alt="질문" /><span>질문 내용이 없습니다.</span></a>
				</p>
				<p class="a">
					<img src="img/skin/a.gif" width="18" height="18" border="0"
						alt="답변" /><span class="noa">답변 내용이 없습니다.</span>
				</p>
			</li>
				<?php }?>
			</ul>
	</div>

	<div class="btnbox">
			<?php include BASE_SKIN_PATH."admin.inc.php"; ?>
			<?php if($grantValue['auth_write']){?>
			<a class="btn btn-default"
			href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write"
			title="글쓰기">글쓰기</a>
			<?php }?>
		</div>

	<?php 	if($grantValue['auth_admin']){?>
	</form>
<?php }?>
<?php include BASE_SKIN_PATH."pagination.inc.php"?>



