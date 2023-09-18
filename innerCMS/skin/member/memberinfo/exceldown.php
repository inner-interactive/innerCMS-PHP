<?php
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

if(!$isAdmin) alert('접근 권한이 없습니다.');

$DB = new DB();

$_GET['isblocked'] = 0;
$where = $DB->whereSql("%subject|%memo|!isblocked");
$orderby = " ORDER BY jointime DESC, indexcode DESC";

$query = "SELECT * FROM ".MEMBER_TABLE.$where.$orderby;
$memberData = $DB->getDBData($query);
$file_name = "회원내역_".TIME_YMD.".xls";

header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
header( "Content-Disposition: attachment; filename={$file_name}" );
header( "Content-Description: PHP5 Generated Data" );
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");
	 
?>
<html>
	<head>
		<title>회원내역</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>

	<table border="1">
		<thead>
			<tr class="usebg">
				<th scope="col">아이디</th>
				<th scope="col">이름</th>
				<th scope="col">성별</th>
				<th scope="col">전화번호</th>
				<th scope="col">이메일</th>
				<th scope="col">회원권한</th>
				<th scope="col">최근로그인</th>
				<th scope="col">가입일</th>
			</tr>
		</thead>

		<tbody>
			<? 
			for($i=0; $i<count($memberData); $i++){
				?>
			<tr>
				<td><?=$memberData[$i]['userid']?></td>
				<td><?=$memberData[$i]['realname']?></td>
				<td><?=$memberData[$i]['sex'] == "M" ? "남" : "여"?></td>
				<td><?=$memberData[$i]['phone']?></td>
				<td><?=$memberData[$i]['email']?></td>
				<td><?=getGroupName($memberData[$i]['authlevel'])?></td>
				<td><?=$memberData[$i]['lastlogintime']?></td>
				<td><?=$memberData[$i]['jointime']?></td>
			</tr>
			<?}?>
			<?if(count($memberData)==0){?>
			<tr>
				<td colspan="8">조건에 해당되는 회원이 존재하지 않습니다.</td>
			</tr>
			<?}?>
		</tbody>
	</table>

	</body>
</html>
