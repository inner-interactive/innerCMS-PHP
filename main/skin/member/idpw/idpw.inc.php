<?if($userID == ""){?>

<div class="idpwsearchbox">

		<ul id="idpwsearch">
				<li>
					<p>ID Search <span> 아이디를 잊으셨습니까?</span></p>
					<form action="<?=SKIN_URL?>findid.php" method="post">
						<fieldset>
						<legend>아이디찾기항목</legend>
						 <span class="loginform">
							<span class="idsearchlist"><label for="name">이름</label><input name="name" type="text" id="name" title="회원 가입시 입력된 실명 입력" /></span>
							<span><label for="email">이메일 주소</label><input name="email" type="text" id="email" title="회원 가입시 입력한 이메일주소 입력" /></span>
							</span>
							<div class="loginbt"><input class="idpw_sbtn" type="submit" value="찾기" /></div>
						</fieldset>
						<input type="hidden" name="backUrl" value="<?=getBackUrl("menu", 1)?>" />
					</form>
				</li>

				<li>
					<p>Password Search<br /> <span> 비밀번호를 잊으셨습니까? 회원님의 정보는 입력하신 이메일주소로  발송됩니다.</span></p>
					<form action="<?=SKIN_URL?>findpw.php" method="post">
						<fieldset>
							<legend>패스워드찾기항목</legend>
							 <span class="loginform">
								<span><label for="id2">아이디</label><input name="userid" type="text" id="id2" title="회원 아이디입력" /></span>
								<span><label for="name2">이름</label><input name="name" type="text" id="name2" title="회원 이름입력" /></span>
								<span><label for="email2">이메일 주소</label><input name="email" type="text" id="email2" title="회원 가입시 입력한 이메일주소 입력" /></span>
							</span>
							<div class="loginbt2"><input class="idpw_sbtn" type="submit" value="찾기" /></div>
						</fieldset>
						<input type="hidden" name="backUrl" value="<?=getBackUrl("menu", 1)?>" />
					</form>
				</li>
			</ul>

<?}else{?>
<div>
	<p>이미 로그인 되어있습니다.</p>
</div>
<?}?>

</div>