<?php include BASE_SKIN_PATH."category.inc.php" ?>
<?php include BASE_SKIN_PATH."search.inc.php" ?>
<div class="gallerybox_page_list">

	<?php 	if($grantValue['auth_admin']){?>
	<form action="admin.php" method="post" enctype="multipart/form-data">
		<?php if($grantValue['auth_admin']){?>
		<div class="gallery_index">
			<input type="checkbox" name="indexnoTop" id="indexnoAllCheck" /> <label
				for="indexnoAllCheck">전체 목록 선택</label>
		</div>
		<?php }?>
	<?php }?>
		<ul>
			<?php
$dbData = $system['data']['dbData'];
for ($i = 0; $i < count($dbData); $i ++) {
    $del_in = intval($dbData[$i]['delflag']) == 1 ? "<del>" : "";
    $del_out = intval($dbData[$i]['delflag']) == 1 ? "</del>" : "";
    $writetime = $dbData[$i]['replytime'] == "" ? $dbData[$i]['writetime'] : $dbData[$i]['replytime'];
    $viewLink = getBackUrl("menu|pno|category|limit|sfv|" . $_GET['sfv'] . "|opt") . "&amp;mode=view&amp;no=" . $dbData[$i]['indexcode'];
    $thumbInfo = $SKIN->getFileData($menuID, $dbData[$i]['indexcode'], 'thumb');
    $fileInfo = $SKIN->getFileData($menuID, $dbData[$i]['indexcode'], 'files');
    $fileLink = "../data/upload/" . $fileInfo[0]['attach_file_name'];
    ?>
			<li>
				<div class="box" style="width:<?=$SKIN->thumbnailWidth?>px;">
					<?php if($grantValue['auth_admin']){?><input type="checkbox"
						class="indexno" name="indexno[]"
						value="<?=$dbData[$i]['indexcode']?>" /><?php }?>
					<a href="<?=$viewLink?>" target="_blank" title="<?=$dbData[$i]['subject']?> 내용 보기" style="width:<?=$SKIN->thumbnailWidth?>px; height:<?=$SKIN->thumbnailHeight?>px">
						<?php if(count($thumbInfo) > 0){  ?>
						<img src="../data/upload/<?=$thumbInfo[0]['attach_file_name']?>"
						alt="<?=$dbData[$i]['subject']?> 섬네일 파일" />
						<?}else{?>
						<img src="img/skin/noimg.png" alt="노이미지 썸네일 이미지" />
						<?}?>
					</a>
					<div class="info brochure-info">
						<strong><a href="<?=$fileLink?>" target="_blank"><?php echo $del_in.$dbData[$i]['subject'].$del_out?></a></strong>
						<?php if($grantValue['auth_write']){?>
						<a href="<?=$viewLink?>" class="viewadmin brochure-admin"
							title="<?=$dbData[$i]['subject']?> 내용 보기">관리자 보기</a>
						<?php }?>
					</div>
					<span class="box-cover brochure-cover" style="width:<?=$SKIN->thumbnailWidth?>px; height:<?=$SKIN->thumbnailHeight?>px">
						<a href="<?=$fileLink?>" target="_blank"
						title="<?=$dbData[$i]['subject']?> 내용 보기"></a>
					</span>
				</div>

			</li>
			<?php }?>
			<?php if(count($dbData) == 0){?>
			<li style="width: 100%">조건에 해당되는 글이 존재하지 않습니다.</li>
			<?php }?>
		</ul>
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
</div>
<?php include BASE_SKIN_PATH."pagination.inc.php"?>



