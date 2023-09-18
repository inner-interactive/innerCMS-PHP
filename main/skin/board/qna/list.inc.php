

<div class="searchbar qna_auth">

	<div class="categorySelect">
		<form action="<?=SKIN_URL?>status.php" method="post">
			<fieldset>
				<legend>처리상태</legend>
				<select name="status" title="처리상태 옵션">
					<option value="">전체보기</option>
					<?php for($i = 0; $i < count($statusList); $i++){?>
					<option value="<?=$statusList[$i]?>"
						<?=isselected($statusList[$i], $status)?>><?=$statusList[$i]?></option>
					<?php }?>
				</select> <input type="hidden"
					value="<?=getBackUrl("menu|mode|limit|sfv|".$_GET['sfv']."|opt", 1)?>"
					name="backUrl" /> <input type="submit" value="처리상태별 보기" />
			</fieldset>
		</form>
	</div>

	<?php if($SKIN->categoryUse){?>
	<div class="categorySelect">
		<form action="categorylink.php" method="post">
			<fieldset>
				<legend>카테고리</legend>
				<select name="category" title="카테고리 옵션">
					<option value="">전체보기</option>
					<?php for($i = 0; $i < count($SKIN->categoryList); $i++){?>
					<option value="<?=$SKIN->categoryList[$i]?>"
						<?=isselected($SKIN->categoryList[$i], $category)?>><?=$SKIN->categoryList[$i]?></option>
					<?php }?>
				</select> <input type="hidden"
					value="<?=getBackUrl("menu|mode|limit|sfv|".$_GET['sfv']."|opt")?>"
					name="backUrl" /> <input type="submit" value="카테고리로 보기"
					title="선택한 카테고리로 보기" />
			</fieldset>
		</form>
	</div>
	<?php }?>

	<?
$option = array(
    "subject|제목",
    "memo|내용",
    "uname|작성자"
);
?>
	<form action="searchlink.php" method="post" class="search">
		<fieldset>
			<legend>검색</legend>
			<select name="sf" title="검색 옵션">
				<? for($i = 0; $i < count($option); $i++){ $optionDiv = explode("|", $option[$i]);?>
				<option value="<?=$optionDiv[0]?>"
					<?=isselected($optionDiv[0], $_GET['sfv'])?>><?=$optionDiv[1]?></option>
				<?}?>
			</select> <span class="item"><label for="sv" class="labelhidden">검색어</label><input
				name="sv" type="text" id="sv" placeholder="검색어를 입력하세요" class="iText"
				value="<?=$_GET[$_GET['sfv']]?>" /></span> <input type="hidden"
				value="<?=getBackUrl("menu|mode|category|limit|opt")?>"
				name="backUrl" /> <span class="btnSearch"> <input type="image"
				src="img/skin/btnSearch.png" alt="검색" title="검색하기" />
			</span>
		</fieldset>
	</form>
</div>

<div class="page_list">
	<?php 	if($grantValue['auth_admin']){?>
	<form action="admin.php" method="post" enctype="multipart/form-data">
	<?php }?>

		<table>
			<caption><?=$system['data']['position'][0]['menu_title']?> 리스트</caption>
			<thead>
				<tr>
					<th scope="col" nowrap>번호</th>
					<th scope="col"><?php if($grantValue['auth_admin']){?><input
						type="checkbox" name="indexnoTop" id="indexnoAllCheck" /><?php }?>제목</th>
					<th scope="col" class="stout">상태</th>
					<th scope="col" class="mhide">작성자</th>
					<th scope="col" class="mhide">등록일</th>
					<th scope="col" class="mhide" nowrap>조회</th>
				</tr>
			</thead>
			<tbody>
				<?php

$dbData = $system['data']['dbData'];
    for ($i = 0; $i < count($dbData); $i ++) {
        $del_in = intval($dbData[$i]['delflag']) == 1 ? "<del>" : "";
        $del_out = intval($dbData[$i]['delflag']) == 1 ? "</del>" : "";
        $writetime = $dbData[$i]['replytime'] == "" ? $dbData[$i]['writetime'] : $dbData[$i]['replytime'];
        ?>
				<tr>
					<th scope="row" class="mnom" nowrap><?=$pagenumstart - $i?></th>
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
						<a
						href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=view&amp;no=<?=$dbData[$i]['indexcode']?>"
						title="<?=$dbData[$i]['subject']?> 내용 보기">
						<?=$del_in.strcut($dbData[$i]['subject'], $SKIN->subjectLimitNum).$del_out?>
						</a>
						<?if($dbData[$i]['cmtNum'] != 0){?><b class="cmtstat">[<?=$dbData[$i]['cmtNum']?>]</b><?}?>
						<?php if(isNew($writetime)){?><img src="img/skin/new.gif"
						alt="최신글" /><?php }?>
						<div class="mshow"><?=$dbData[$i]['uname']?></div>
					</td>
					<td class="stout"><?=getStatusIcon($dbData[$i]['f1'])?></td>
					<td class="mhide" nowrap><?=$dbData[$i]['uname']?></td>
					<td class="mhide" nowrap><?=str_replace("-", ".", substr($writetime, 0, 10))?></td>
					<td class="mhide" nowrap><?=$dbData[$i]['view']?></td>
				</tr>
				<?php }?>
				<?php if(count($dbData) == 0){?>
				<tr>
					<td colspan="6">조건에 해당되는 글이 존재하지 않습니다.</td>
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



