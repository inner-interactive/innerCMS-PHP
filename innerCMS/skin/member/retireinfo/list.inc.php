<?php 
$dbData = $system['data']['dbData'];
?>
	<table class="table_basic th-g">
		<caption>블랙리스트 회원 리스트</caption>
		<thead>
			<tr>
				<th>번호</th>
				<th>아이디</th>
				<th>이름</th>
				<th>닉네임</th>
				<th>성별</th>
				<th>탈퇴일</th>
				<th>회원권한</th>
				<th>최근로그인</th>
				<th>가입일</th>
				<th>보기</th>
			</tr>
		</thead>
		<tbody>
		<?php for($i = 0; $i < count($dbData); $i++){
			$_viewLink = getBackUrl("menu")."&amp;mode=view&amp;no=".$dbData[$i]['indexcode'];
		?>
		<tr>
			<th><?=$pagenumstart - $i?></th>
			<td><?=$dbData[$i]['userid']?></td>
			<td><?=$dbData[$i]['realname']?></td>
			<td><?=$dbData[$i]['nickname']?></td>
			<td>
			<?php 
				if($dbData[$i]['sex'] == "M"){
			?>
				<span class="icon_man">남</span>
			<?php 
				}else if($dbData[$i]['sex'] == "W"){
			?>
				<span class="icon_woman">여</span>
			<?php 
				}
			?>
			</td>
			<td><?=$dbData[$i]['retiretime']?></td>
			<td><?=getGroupName($dbData[$i]['authlevel'])?></td>
			<td><?=$dbData[$i]['lastlogintime']?></td>
			<td><?=$dbData[$i]['jointime']?></td>
			<td><a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a></td>
		</tr>
		<?php }?>
		</tbody>
	</table>
	

<?php include BASE_SKIN_PATH."pagination.inc.php"?>


