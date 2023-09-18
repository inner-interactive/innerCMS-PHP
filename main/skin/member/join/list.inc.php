<div class="agree_wrapper">
	<form action="<?=SKIN_URL?>agree.php" method="post">
		<ul class="memberstep">
			<li class="tab_on">01 약관동의</li>
			<li>02 개인정보입력</li>
			<li>03 회원가입완료</li>
		</ul>
		<h3 class="stipultitle">이용약관</h3>
		<?php include "stipul.php";?>
		<fieldset class="stipul_text">
			<legend>약관에 동의하시겠습니까?</legend>
			<div class="input-row">
				<label for="agree_bit1"> <input type="checkbox" id="agree_bit1"
					name="agree_bit1" /> 약관에 동의합니다.
				</label>
			</div>
		</fieldset>
		<h3 class="stipultitle">개인정보취급방침</h3>
		<?php include "private.php";?>
		<fieldset class="stipul_text">
			<legend>약관에 동의하시겠습니까?</legend>
			<div class="input-row">
				<label for="agree_bit2"> <input type="checkbox" id="agree_bit2"
					name="agree_bit2" /> 개인정보수집에 동의합니다.
				</label>
			</div>
		</fieldset>
		<input name="opt" type="hidden" value="0" /> <input type="hidden"
			name="opt" value="0" /> <input type="hidden" name="backUrl"
			value="<?=getBackurl("menu|pno|category|limit|no|".$_GET['sfv']."|sfv|opt", 1)?>" />
		<div class="formbt2">
			<input type="submit" value="다음단계로이동" />
		</div>
	</form>
</div>