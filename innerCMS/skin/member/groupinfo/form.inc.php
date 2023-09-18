<?php
$dbData = $system['data']['dbData'];
?>
<table class="table_basic" border="0" cellspacing="0" cellpadding="0">
	<caption>권한 정보 입력</caption>
	<tbody>
		<tr>
			<th scope="col"><label for="groupname">그룹명</label></th>
			<td class="tleft"><input type="text" id="groupname" name="groupname" value="<?=$dbData['groupname']?>"class="inputs" /></td>
			<th scope="col"><label for="name">권한명</label></th>
			<td class="tleft"><input type="text" id="name" name="name" value="<?=$dbData['name']?>" class="inputs" /></td>
			<th scope="col"><label for="authlevel">권한레벨</label></th>
			<td class="tleft">
				<input type="text" id="authlevel" name="authlevel" value="<?=$dbData['authlevel']?>" class="inputs w100" />
				<span>0 ~ 99 사이의 숫자값만 입력해 주세요. 숫자가 높을 수록 권한이 높습니다.</span>
			</td>
		</tr>
	</tbody>
</table>

	


