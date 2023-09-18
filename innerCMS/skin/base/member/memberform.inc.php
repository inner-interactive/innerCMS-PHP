<?php
$dbData = $system['data']['dbData'];
?>
<table class="table_basic" border="0" cellspacing="0" cellpadding="0" summary="회원정보">
	<caption>회원정보 입력</caption>
	<colgroup>
		<col width="20%">
		<col width="30%">
		<col width="20%">
		<col width="30%">
	</colgroup>
	<tbody>
		<tr>
			<th scope="col"><label for="userid">아이디*</label></th>
			<td class="tleft"><input type="text" id="userid" name="userid" value="<?=$dbData['userid']?>" <?php if($mode == "update"){?>readonly<?php }?> class="inputs" /></td>
			<th scope="col"><label for="userpw">패스워드<?if($mode == "write"){?>*<?php }?></label></th>
			<td class="tleft"><input type="password" id="userpw" name="userpw" value="" class="inputs" /></td>
		</tr>
		<tr>
			<th scope="col"><label for="realname">실명*</label></th>
			<td class="tleft"><input type="text" id="realname" name="realname" value="<?=$dbData['realname']?>" class="inputs" /></td>
			<th scope="col"><label for="nickname">닉네임*</label></th>
			<td class="tleft"><input type="text" id="nickname" name="nickname" value="<?=$dbData['nickname']?>" class="inputs" /></td>
		</tr>
		<tr>
			<th scope="col"><label for="authlevel">회원권한</label></th>
			<td class="tleft" colspan="3">
			<select name="authlevel" id="authlevel">
				<?php foreach($groupList as $value){?>
				<option value="<?=$value['authlevel']?>" <?=isselected($value['authlevel'], $dbData['authlevel'])?>><?=$value['name']?></option>
				<?php }?>
			</select>
			</td>
		</tr>
		<tr>
			<th scope="col">성별</th>
			<td class="tleft">
				<input type="radio" name="sex" id="man" value="M" <?=ischecked("M", $dbData['sex'])?> />
				<label for="man"><span class="icon_man">남</span></label>
				<input type="radio" name="sex" id="woman" value="W" <?=ischecked("W", $dbData['sex'])?> />
				<label for="woman"><span class="icon_woman">여</span></label>
			</td>
			<th scope="col"><label for="birth">생년월일</label></th>
			<td class="tleft"><input type="date" name="birth" id="birth" value="<?=$dbData['birth']?>" class="inputs" /></td>
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
			<th scope="col"><label for="mobile">휴대폰</label></th>
			<td class="tleft"><input type="text" id="mobile" name="mobile" value="<?=$dbData['mobile']?>" class="inputs" /></td>
			<th scope="col"><label for="phone">유선전화</label></th>
			<td class="tleft"><input type="text" id="phone" name="phone" value="<?=$dbData['phone']?>" class="inputs" /></td>
		</tr>
		<tr>
			<th scope="col"><label for="email">이메일</label></th>
			<td class="tleft"><input type="text" id="email" name="email" value="<?=$dbData['email']?>" class="inputs" /></td>
			<th scope="col"><label for="url">홈페이지</label></th>
			<td class="tleft"><input type="text" id="url" name="url" value="<?=$dbData['url']?>" class="inputs" /></td>
		</tr>
		<tr>
			<th scope="col">주소</th>
			<td class="tleft" colspan="3">
			<input type="text" name="zipcode" id="zipcode" value="<?=$dbData['zipcode']?>" class="inputs w100" />
			<button type="button" class="in_btn btn_apply" id="zipsearch">주소검색</button>
			<div class="address_layer">
				<input type="text" name="address" id="address" value="<?=$dbData['address']?>" class="inputs wd50" /><label for="address">기본주소</label>
				<input type="text" name="address2" id="address2" value="<?=$dbData['address2']?>" class="inputs wd50" /><label for="address2">상세주소</label>
				<input type="text" name="address3" id="address3" value="<?=$dbData['address3']?>" class="inputs wd50" /><label for="address3">참고항목</label>
				<input type="hidden" name="address_type" id="address_type" value="<?=$dbData['address_type']?>" class="inputs w100" />
			</div>
			</td>
		</tr>
		<tr>
			<th scope="col">메일링</th>
			<td class="tleft">
				<input type="radio" name="ismailing" id="ismailingY" value="Y" <?=ischecked("Y", $dbData['ismailing'])?> />
				<label for="ismailingY">예</label>
				<input type="radio" name="ismailing" id=ismailingN value="N" <?=ischecked("N", $dbData['ismailing'])?> />
				<label for="ismailingN">아니오</label>
			</td>
		</tr>
		<tr>
			<th scope="col"><label for="memo">메모</label></th>
			<td colspan="3" class="tleft"><textarea name="memo" id="memo" cols="30" rows="10" style="width:100%;"><?=$dbData['memo']?></textarea></td>
		</tr>
	</tbody>
</table>

<?php echo POSTCODE_JS?>