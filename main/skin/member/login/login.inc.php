<?php
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    ?>
<div>
	<p>이미 로그인 되어있습니다.</p>
</div>
<?
} else {
    $backUrl = isset($_GET['backUrl']) && $_GET['backUrl'] != "" ? trim($_GET['backUrl']) : getBackUrl('', 1);
    ?>
<div id="Loginwrap">
	<h4>
		<!--<?=$system['site']['author']?><br /> <strong>홈페이지를 방문해 주셔서 감사합니다.</strong>-->
		<?=$system['site']['author']?><br /> <strong>로그인 화면입니다.</strong>
	</h4>
	<div id="loginbg">
		<p>아이디 / 비밀번호를 입력하세요.</p>
		<form action="<?=SKIN_URL?>login.php" method="post">
			<fieldset>
				<legend>로그인항목</legend>
				<span class="loginform"> 
    				<label class="login_id" for="userid">아이디</label> 
    				<input name="userid" type="text" id="userid" title="아이디" placeholder="아이디" /> 
    				<label class="login_pass" for="userpw">비밀번호</label> 
    				<input name="userpw" type="password" id="userpw" title="비밀번호" autocomplete="off" placeholder="비밀번호" />
				</span> 
				<input class="loginbt" type="submit" title="로그인" value="로그인" /> 
				<input type="hidden" name="menu" value="<?=$menuID?>" /> 
				<input type="hidden" name="backUrl" value="<?=$backUrl?>" />
			</fieldset>
		</form>
	</div>
	<ul class="login_btn">
		<li><a href="route.php?action=join" title="회원가입으로 이동">회원가입</a></li>
		<li><a href="route.php?action=idpw" title="아이디찾기로 이동">아이디 / 비밀번호 찾기</a></li>
	</ul>
	<p class="txt">
		번호 도용을 막기 위해 <span>영문, 숫자, 특수문자의 조합</span>으로 이루어진 비밀번호를 만드는 것을 권장하며, 정기적으로 비밀번호를 수정해 주시길 바랍니다.
	</p>
</div>
<?}?>
