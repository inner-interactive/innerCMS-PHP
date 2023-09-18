<?php
if(isset($system['jscss']['js'])) setScriptTagArray($system['jscss']['js']);
if(isset($system['jscss']['js_skin'])) setScriptTagArray($system['jscss']['js_skin']);
?>

<?php if($login_menuID != $menuID){?>
<footer id="footer">
	<div class="copybox">
		<h2>주소 및 저작권</h2>
		<div class="bottommenu">
			<ul class="dept">
				<li><a href="http://inner515.co.kr/" target="_blank" title="이너인터랙티브 홈페이지로 이동">inner interactive</a></li>
			</ul>
		</div>
		<div class="bottombox">ⓒ 2001-<?=date("Y")?> inner interactive. All rights reserved.</div>
	</div>
</footer>

<!-- 스킵 네비게이션 시작-->
<div class="Skipul">
	<h2>리뷰 네비게이션</h2>
	<ul>
		<li><a href="#gnb" title="메뉴로 바로 가기" class="skip">메뉴로 다시가기</a></li>
		<li><a href="#contwrap" title="본문으로 바로가기" class="skip">본문으로 다시가기</a></li>
		<li><a href="#footer" title="연락처 및 저작권으로 바로가기" class="skip">연락처및저작권으로 다시가기</a></li>
	</ul>
</div>
<!-- 스킵 네비게이션 종료-->
<?php }?>
</body>
</html>