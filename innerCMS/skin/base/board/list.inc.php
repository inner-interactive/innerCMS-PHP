<?php include "category.inc.php"; ?>
<?php include "search.inc.php" ?>
<div class="page_list">
	<?php 	if($grantValue['auth_admin']){?>
	<form action="admin.php" method="post" enctype="multipart/form-data">
	<?php }?>

		<table>
			<caption><?=$system['data']['position'][0]['menu_title']?> 리스트</caption>
			<thead>
				<tr>
					<th scope="col" nowrap>번호</th>
					<th scope="col"><?php if($grantValue['auth_admin']){?><input type="checkbox" name="indexnoTop" id="indexnoAllCheck" /><?php }?>제목</th>
					<th scope="col" class="mhide">작성자</th>
					<th scope="col" class="mhide">등록일</th>
					<th scope="col" class="mhide" nowrap>조회</th>
				</tr>
			</thead>
			<tbody>
				<?php $dbData = $system['data']['dbData']; for($i = 0; $i < count($dbData); $i++){ 
					$del_in = intval($dbData[$i]['delflag']) == 1 ? "<del>" : "";
					$del_out = intval($dbData[$i]['delflag']) == 1 ? "</del>" : "";
					$writetime = $dbData[$i]['replytime'] == "" ? $dbData[$i]['writetime'] : $dbData[$i]['replytime'];
				?>
				<tr>
					<th scope="row" class="mnom" nowrap><?=$pagenumstart - $i?></th>
					<td class="left">
						<?php if($grantValue['auth_admin']){?><input type="checkbox" class="indexno" name="indexno[]" value="<?=$dbData[$i]['indexcode']?>" /><?php }?>
						<?php if($dbData[$i]['isimportant']==1){?><img src="img/skin/important.gif" alt="공지글" /><?php }?>
						<?php if($dbData[$i]['replytime'] != ""){  for($k = 0; $k < intval($dbData[$i]['replyrank']); $k++){?>&nbsp;&nbsp;<?php }?><img src="img/skin/re.gif" alt="답변글" /><?php }?>
						<?php if($dbData[$i]['issecret'] == 1){?><img src="img/skin/secret.gif" alt="비밀글" /><?php }?>
						<?php if($dbData[$i]['category'] != ""){?><span class="listcate">[<?=$dbData[$i]['category']?>]</span><?php }?>
						<a href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=view&amp;no=<?=$dbData[$i]['indexcode']?>" title="<?=$dbData[$i]['subject']?> 내용 보기">
						<?=$del_in.strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum).$del_out?>
						</a>
						<?if($dbData[$i]['cmtNum'] != 0){?><b class="cmtstat">[<?=$dbData[$i]['cmtNum']?>]</b><?}?>
						<?php if(isNew($writetime)){?><img src="img/skin/new.gif" alt="최신글" /><?php }?>
						<div class="mshow"><?=$dbData[$i]['uname']?></div>
					</td>
					<td class="mhide" nowrap><?=$dbData[$i]['uname']?></td>
					<td class="mhide" nowrap><?=str_replace("-", ".", substr($writetime, 0, 10))?></td>
					<td class="mhide" nowrap><?=$dbData[$i]['view']?></td>
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
			<?php include "admin.inc.php"; ?>
			<?php if($grantValue['auth_write']){?>
			<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write" title="글쓰기">글쓰기</a>
			<?php }?>
		</div>

	<?php 	if($grantValue['auth_admin']){?>
	</form>
	<?php }?>
</div>
<?php include "pagination.inc.php"?>



