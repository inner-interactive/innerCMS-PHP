<?php
$dbData = $system['data']['dbData'];
?>

<div class="function mb10">
	<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
</div>

<table class="table_basic" border="0" cellspacing="0" cellpadding="0" summary="회원정보">
	<caption>탈퇴회원정보</caption>
	<colgroup>
		<col width="20%">
		<col width="30%">
		<col width="20%">
		<col width="30%">
	</colgroup>
	<tbody>
		<tr>
			<th scope="col">아이디</th>
			<td class="tleft"><?=$dbData['userid']?></td>
			<th scope="col">실명</th>
			<td class="tleft"><?=$dbData['realname']?></td>
		</tr>
		<tr>
			<th scope="col">닉네임</th>
			<td class="tleft"><?=$dbData['nickname']?></td>
			<th scope="col">회원권한</th>
			<td class="tleft"><?=getGroupName($dbData['authlevel'])?></td>
		</tr>
		<tr>
			<th scope="col">성별</th>
			<td class="tleft">
			<?php 
			if($dbData['sex'] == "M"){
			?>
				<span class="icon_man">남</span>
			<?php 
				}else if($dbData['sex'] == "W"){
			?>
				<span class="icon_woman">여</span>
			<?php 
				}
			?>
			<th scope="col">탈퇴일</th>
			<td class="tleft"><?=$dbData['retiretime']?></td>
		<tr>
			<th scope="col">가입일</th>
			<td class="tleft"><?=$dbData['jointime']?></td>
			<th scope="col">최근로그인</th>
			<td class="tleft"><?=$dbData['lastlogintime']?></td>
		</tr>
		<tr>
			<th scope="col">글작성수</th>
			<td class="tleft"><?=$dbData['docnum']?></td>
			<th scope="col">댓글 작성수</th>
			<td class="tleft"><?=$dbData['cmtnum']?></td>
		</tr>
	</tbody>
</table>

<div class="function mt30">
	<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
</div>