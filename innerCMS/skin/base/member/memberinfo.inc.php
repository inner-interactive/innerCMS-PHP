<table class="table_basic" border="0" cellspacing="0" cellpadding="0" summary="회원정보">
	<caption>회원정보</caption>
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
		</td>
			<th scope="col">생년월일</th>
			<td class="tleft"><?=$dbData['birth']?></td>
		</tr>
		<!-- 
		<tr>
			<th scope="col">회원분류</th>
			<td class="tleft"></td>
			<th scope="col">인증타입</th>
			<td class="tleft"></td>
		</tr>
		 -->
		<tr>
			<th scope="col">휴대폰</th>
			<td class="tleft"><?=$dbData['mobile']?></td>
			<th scope="col">유선전화</th>
			<td class="tleft"><?=$dbData['phone']?></td>
		</tr>
		<tr>
			<th scope="col">이메일</th>
			<td class="tleft"><?=$dbData['email']?></td>
			<th scope="col">홈페이지</th>
			<td class="tleft"><?php if($dbData['url'] != ""){?><a href="<?=$dbData['url']?>" target="_blank"><?php }?><?=$dbData['url']?><?php if($dbData['url'] != ""){?></a><?php }?></td>
		</tr>
		<tr>
			<th scope="col">주소</th>
			<td class="tleft" colspan="3"><?=$dbData['zipcode']?> <?=$dbData['address']?></td>
		</tr>
		<tr>
			<th scope="col">메일링</th>
			<td class="tleft"><?=$dbData['ismailing'] == "Y" ? "예" : "아니오"?></td>
			<th scope="col">로그인수</th>
			<td class="tleft"><?=$dbData['lognum']?></td>
		</tr>
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
		<tr>
			<th scope="col">메모</th>
			<td colspan="3" class="tleft"><?=$dbData['memo']?></td>
		</tr>
	</tbody>
</table>