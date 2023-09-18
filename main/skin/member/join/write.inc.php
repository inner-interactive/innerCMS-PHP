<div class="join_wrapper">
	<form action="<?=SKIN_URL?>write.php" id="join_form" name="join_form" method="post" enctype="multipart/form-data">
		<h2>회원가입절차</h2>
		<ul class="memberstep">
			<li>01 약관동의</li>
			<li class="tab_on">02 개인정보입력</li>
			<li>03 회원가입완료</li>
		</ul>
		<h3 class="stipultitle">개인정보입력</h3>
		<p class="stiuprtext">
			회원님의 개인정보를 안전하게 보호하고 있으며 회원님의 명백한 동의 없이는 공개 또는 제3자에게 제공되지 않습니다. 자세한 내용은 개인정보취급 방침을 확인하여 주십시오. <strong><a href="route.php?action=private">[ 개인정보취급방침 ]</a> </strong>
		</p>
		<div class="formtext">
			<abbr title="필수입력항목">*</abbr> 항목은 필수항목이오니 빠짐없이 입력해 주시기 바랍니다
		</div>
		<div class="stipulbox2">
			<div class="stipulbottom">
				<fieldset>
					<legend>회원가입 신청폼</legend>
					<ul class="formlist">
						<li>
							<span>
								<label for="userid">아 이 디</label>
								<abbr title="필수입력항목">*</abbr>
							</span>
							<input type="text" name="userid" id="userid" value="" title="아이디를 영문자와 숫자만을 사용하여 4글자이상 16글자 이하로 작성" />
							<span class="jointext">(영문,숫자)</span>
							<a href="#" id="idcheck" title="아이디 중복확인">중복확인</a>
						</li>
						<li>
							<span>
								<label for="userpw">비 밀 번 호</label>
								<abbr title="필수입력항목">*</abbr>
							</span>
							<input type="password" name="userpw" id="userpw" value="" title="비밀번호는 보안을 위해 영문자, 숫자 및 특수문자등을 조합하여 작성" />
							<span class="jointext">(영문/영문과 숫자 혼합 8-12자)</span>
						</li>
						<li>
							<span>
								<label for="userpw2">비 밀 번 호 확 인</label>
								<abbr title="필수입력항목">*</abbr>
							</span>
							<input type="password" id="userpw2" name="userpw2" value="" title="비밀번호 확인을 위해 다시 한번 더 입력" />
							<span class="jointext"> (영문/영문과 숫자 혼합 8-12자)</span>
						</li>
						<li>
							<span>
								<label for="realname">실 명</label>
								<abbr title="필수입력항목">*</abbr>
							</span>
							<input type="text" id="realname" name="realname" value="" title="실명 입력" />
						</li>
						<li>
							<span>
								<label for="nickname">닉 네 임</label>
								<abbr title="필수입력항목">*</abbr>
							</span>
							<span class="inputlistall">
								<input type="text" name="nickname" id="nickname" value="" />
								<a href="#" id="nicknamecheck" title="닉네임 중복확인">닉네임중복확인</a>
							</span>
						</li>
						<li>
							<span>
								<label for="email">이 메 일</label>
								<abbr title="필수입력항목">*</abbr>
							</span>
							<input type="text" id="email" name="email" value="" title="이메일 입력, 유효성을 체크합니다." />
							<span class="jointext"> 아이디, 비밀번호 찾을때 필요하오니 반드시 입력해 주세요.</span>
						</li>
						<li>
							<span>
								<label for="sex">성 별</label>
							</span>
							<select id="sex" name="sex">
								<option value="">선택</option>
								<option value="M">남</option>
								<option value="W">여</option>
							</select>
						</li>
						<li>
							<span>
								<label for="birth">생 년 월 일</label>
							</span>
							<input type="text" name="birth" id="birth" value="" />
							<span class="jointext"> ex) 19750101</span>
						</li>
						<li>
							<span>
								<label for="mobile1">휴 대 폰</label>
							</span>
							<select name="mobile1" id="mobile1">
								<option value="">선택</option>
							<?php foreach($system['data']['mobile'] as $value){?>
							<option value="<?php echo $value?>"><?php echo $value?></option>
							<?php }?>
						</select> -
							<input type="text" name="mobile2" value="" maxlength="4" style="width: 50px" />
							-
							<input type="text" name="mobile3" value="" maxlength="4" style="width: 50px" />
						</li>
						<li>
							<span>
								<label for="phone1">유 선 전 화</label>
							</span>
							<select name="phone1" id="phone1">
								<option value="">선택</option>
							<?php foreach($system['data']['phone'] as $value){?>
							<option value="<?php echo $value?>"><?php echo $value?></option>
							<?php }?>
						</select> -
							<input type="text" name="phone2" value="" maxlength="4" style="width: 50px" />
							-
							<input type="text" name="phone3" value="" maxlength="4" style="width: 50px" />
						</li>
						<li>
							<span>
								<label for="zipcode">우 편 번 호</label>
							</span>
							<span class="inputlistall">
								<input type="text" id="zipcode" name="zipcode" value="" title="우편번호 입력" />
								<a href="#" title="우편번호찾기" id="zipsearch">우편번호찾기</a>
							</span>
						</li>
						<li>
							<span>
								<label for="address">주 소</label>
							</span>
							<input type="text" id="address" name="address" value="" placeholder="기본주소" title="기본주소" />
							<input type="text" id="address2" name="address2" value="" placeholder="상세주소" title="상세주소" />
							<input type="text" id="address3" name="address3" value="" placeholder="참고항목" title="참고항목" />
							<input type="hidden" id="address_type" name="address_type" value="" title="주소타입" />
						</li>
						<li>
							<span>
								<label for="ismailing">메 일 링</label>
							</span>
							<select id="ismailing" name="ismailing">
								<option value="Y">예</option>
								<option value="N">아니오</option>
							</select>
						</li>
						<li>
							<span>
								<label for="memo">메 모</label>
							</span>
							<textarea id="memo" name="memo" style=""></textarea>
						</li>
					</ul>
				</fieldset>
			</div>
		</div>
		<div class="formbt">
			<input type="submit" value="확인" />
			<a href="<?=getBackUrl("menu|pno|cate|limit|no|".$_GET['sfv']."|sfv|opt")?>&amp;mode=list" title="뒤로">취소</a>
			<input type="hidden" name="menu" value="<?php echo $menuID?>" />
			<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|site|pagetype', 1)."&mode=success"?>" />
		</div>
	</form>
</div>
<script type="text/javascript">
var skinUrl = '<?=SKIN_URL?>';
</script>
<?php echo POSTCODE_JS?>