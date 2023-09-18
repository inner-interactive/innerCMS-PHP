<?php include BASE_SKIN_PATH."category_search.inc.php"; ?>

<div class="page_list">
	<?php 	if($grantValue['auth_admin']){?>
	<form action="admin.php" method="post" enctype="multipart/form-data">
	<?php }?>

		<table>
			<caption><?=$system['data']['position'][0]['menu_title']?> 리스트</caption>
			<thead>
				<tr>
					<th scope="col" nowrap>번호</th>
					<th scope="col"></th>
					<th scope="col"><?php if($grantValue['auth_admin']){?><input
						type="checkbox" name="indexnoTop" id="indexnoAllCheck" /><?php }?>기사제목</th>
					<th scope="col" class="mhide">매체</th>
					<th scope="col" class="mhide">날짜</th>
				</tr>
			</thead>
			<tbody>
				<?php

$dbData = $system['data']['dbData'];
    for ($i = 0; $i < count($dbData); $i ++) {
        $del_in = intval($dbData[$i]['delflag']) == 1 ? "<del>" : "";
        $del_out = intval($dbData[$i]['delflag']) == 1 ? "</del>" : "";
        $writetime = $dbData[$i]['replytime'] == "" ? $dbData[$i]['writetime'] : $dbData[$i]['replytime'];
        $viewLink = getBackUrl("menu|pno|category|limit|sfv|" . $_GET['sfv'] . "|opt") . "&amp;mode=view&amp;no=" . $dbData[$i]['indexcode'];
        $urlLink = $dbData[$i]['f2'] != "" ? trim($dbData[$i]['f2']) : "#";
        $target = $dbData[$i]['f2'] != "" ? "target=\"_blank\"" : "";
        ?>
				<tr>
					<th scope="row" class="mnom" nowrap><?=$pagenumstart - $i?></th>
					<td>
						<?php if($dbData[$i]['f2'] != ""){?>
						<a href="<?=$dbData[$i]['f2']?>" class="url" target="_blank"><img
							src="img/skin/homepage.gif"
							id="favi_<?=$dbData[$i]['indexcode']?>" class="favicon" /></a>
						<?php }?>
					</td>
					<td class="left">
						<?php if($grantValue['auth_admin']){?><input type="checkbox"
						class="indexno" name="indexno[]"
						value="<?=$dbData[$i]['indexcode']?>" /><?php }?>
						<?php if($dbData[$i]['isimportant']==1){?><img
						src="img/skin/important.gif" alt="공지글" /><?php }?>
						<?php if($dbData[$i]['replytime'] != ""){  for($k = 0; $k < intval($dbData[$i]['replyrank']); $k++){?>&nbsp;&nbsp;<?php }?><img
						src="img/skin/re.gif" alt="답변글" /><?php }?>
						<?php if($dbData[$i]['issecret'] == 1){?><img
						src="img/skin/secret.gif" alt="비밀글" /><?php }?>
						<?php if($dbData[$i]['category'] != ""){?><span class="listcate">[<?=$dbData[$i]['category']?>]</span><?php }?>
						<a href="<?=$urlLink?>" title="<?=$dbData[$i]['subject']?> 내용 보기"
						<?=$target?>>
						<?=$del_in.strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum).$del_out?>
						<img src="img/skin/golink.png" alt="새창으로 보기" class="golinkimg" />
					</a>
						<?if($dbData[$i]['cmtNum'] != 0){?><b class="cmtstat">[<?=$dbData[$i]['cmtNum']?>]</b><?}?>
						<?php if(isNew($writetime)){?><img src="img/skin/new.gif"
						alt="최신글" /><?php }?>
						<div class="mshow"><?=$dbData[$i]['f1']?></div>
						<?php if($grantValue['auth_write']){?>
						<a href="<?=$viewLink?>" class="viewadmin"
						title="<?=$dbData[$i]['subject']?> 내용 보기">관리자 보기</a>
						<?php }?>
					</td>
					<td class="mhide" nowrap><?=$dbData[$i]['f1']?></td>
					<td class="mhide" nowrap><?=str_replace("-", ".", substr($writetime, 0, 10))?></td>
				</tr>
				<?php }?>
				<?php if(count($dbData) == 0){?>
				<tr>
					<td colspan="5">조건에 해당되는 글이 존재하지 않습니다.</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
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



