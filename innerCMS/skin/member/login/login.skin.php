<?php if($userID != ""){?>
<div>
	<p>이미 로그인 되어있습니다.</p>
	<p><a href="./">메인페이지로 이동</a></p>
</div>
<?php }else{?>
<div id="loginwrapper">
	<div class="subwrapper">
		<p class="logo"><?=$system['site']['author']?></p>
		<div class="login">
			<dl>
				<dt>
					<img src="<?=SKIN_URL?>img/logintext.png" width="302" height="54" class="png24" alt="Membership Login 아이디와 비밀번호를 입력해주세요">
				</dt>
				<dd>
					<form action="<?=SKIN_URL?>login.php" method="post">
						<fieldset>
							<legend>로그인항목</legend>
							<span class="loginform">
								<span>
									<label for="userid"><img src="<?=SKIN_URL?>img/id.png" width="53" height="23" alt="아이디"></label>
									<input name="userid" type="text" id="userid" class="inpstyle" title="아이디">
								</span>
								<span>
									<label for="userpw"><img src="<?=SKIN_URL?>img/password.png" width="53" height="23" alt="비밀번호"></label>
									<input name="userpw" type="password" id="userpw" class="inpstyle" title="비밀번호">
								</span>
							</span> 
							<span class="loginbt">
								<input type="image" src="<?=SKIN_URL?>img/loginbt.png" class="png24" alt="로그인">
							</span>
							<input type="hidden" name="menu" value="<?=$menuID?>" />
							<input type="hidden" name="backUrl" value="../../../" />
						</fieldset>
					</form>
				</dd>
			</dl>
		</div>
		<div class="copyright">
			<span>ⓒ 2001-<?=date("Y")?> <strong>inner interactive.</strong> All rights reserved.
			</span>
		</div>
	</div>
</div>

<?}?>
