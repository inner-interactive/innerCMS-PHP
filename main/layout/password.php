<section class="subcontent">
	<div class="subg">
		<p>스마트한 이노베이션의 시작</p>
		<p>『Internet based Total e-solution Development』</p>
		<span class="line"></span>
	</div>
	<div class="subnav">
		<div class="container">
			<?php // include "lnb.inc";?>
			<div class="printw">
				<a class="addthis_button_url btn-b2" href="#" title="URL 공유"></a> 
				<a class="addthis_button_url btn-b3" href="#" title="프린트"></a>
				<div class="util-search togglebar">
					<a href="#none" class="search search_open mserchico"><img src="img/inc/mm_searchw.png" alt="검색" /></a>
				</div>
			</div>
			<div class="hiddenoverw">
				<a class="addthis_button_url btn-b1" href="#" title="SNS 공유"></a> 
				<span class="hiddenover"> 
    				<a class="addthis_sns_url btn-sns1" href="javascript:sendTwitterList('<?=$head_title?>', '<?=urlencode($full_url)?>');" title="트위터 공유"></a> 
    				<a class="addthis_sns_url btn-sns2" href="javascript:sendFacebookList('<?=$head_title?>', '<?=urlencode($full_url)?>');" title="페이스북 공유"></a> 
    				<a class="addthis_sns_url btn-sns3" href="javascript:sendGoogleList('<?=$head_title?>', '<?=urlencode($full_url)?>');" title="구글 공유"></a>
				</span>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="subconBox">
			<div class="subreport" id="ar_start">
				<div class="subreporttitle">
					비밀번호 입력<span></span>
				</div>
			</div>
		</div>
		<div class="contsBox">
			<div class="password_wrapper">
				<form action="password_check.php" method="post">
					<fieldset>
						<legend>글 비밀번호 입력</legend>
						<p class="msg">
							<label for="upw">글 비밀번호를 입력해 주세요.</label>
						</p>
						<input type="password" id="upw" name="upw" />
						<?php $backUrl = isset($_GET['backUrl']) ? trim($_GET['backUrl']) : ""?>
						<a href="<?=getPasswordPageBackUrl($backUrl)?>" class="btn btn-default">뒤로</a> 
						<input type="submit" value="확인" class="btn btn-enter" /> 
						<input type="hidden" name="backUrl" value="<?=$backUrl?>" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>


<div class="quickmenu">
	<div class="qucick-arr">
		<a href="#" class="top"><img src="img/inc/quickarr.png" alt="top" /></a>
	</div>
</div>
