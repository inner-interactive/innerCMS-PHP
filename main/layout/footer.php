<!-- 여기에 footer 내용 입력  -->
<section class="footDiv">
	<div class="footer">
		<div class="inner">
			<div class="policybox">
				<ul>
					<li><a href="route.php?action=private"><span>개인정보처리방침</span></a></li>
					<li><a href="route.php?action=stipul"><span>홈페이지이용약관</span></a></li>
					<li><a href="route.php?action=sitemap"><span>사이트맵</span></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footaddress">
		<div class="inner">
			<div class="addressGrap">
				<div class="addressbox">
					<div class="addressw">
						<div class="addresstitle">
							<p>전주비전대학교 55069 전라북도 전주시 완산구 천잠로 235<em> 대표전화 063-220-4114 팩스번호 063-220-3629</em></p>
						</div>
					</div>
				</div>
				<div class="footsns">
					<span>
						<a class="addthis_sns_url btn-sns1" href="https://www.youtube.com/channel/UCJzEYFv0PUZEsRPcKz_ffOQ" target="_blank" title="유튜브 공유"></a> 
						<a class="addthis_sns_url btn-sns2" href="https://www.facebook.com/jvision76" target="_blank" title="페이스북 공유"></a> 
						<a class="addthis_sns_url btn-sns3" href="http://instagram.com/jeonju_vision" target="_blank" title="인스타 공유"></a> 
						<a class="addthis_sns_url btn-sns4" href="https://blog.naver.com/jvu_mngr" target="_blank" title="네이버 공유"></a>
					</span>
				</div>
				<div class="copyright">
					Copyright 2001-<?=date("Y")?> VISION COLLEGE OF JEONJU. All Rights Reserved.
					<?php if($userID){?>
					<a href="route.php?action=logout&backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|".$_GET['sfv']."|sfv|opt"))?>"><img src="img/btn_admin_on.png" alt="로그아웃" title="로그아웃" style="margin-left: 2px;" /></a>
					<?php if($isAdmin){?><a href="../innerCMS/">ADMIN</a><?php }?>
					<?php }else{?>
					<a href="route.php?action=login&backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|".$_GET['sfv']."|sfv|opt", 1))?>"><img src="img/btn_admin.png" alt="로그인" title="로그인" style="margin-left: 2px;" /></a>
					<?php }?>
				</div>
				<div class="footsnsw"></div>
			</div>
		</div>
	</div>
</section>

<?php include 'banner/tag.inc.php'?>

<?php
if(isset($system['jscss']['js'])) setScriptTagArray($system['jscss']['js']);
if(isset($system['jscss']['js_skin'])) setScriptTagArray($system['jscss']['js_skin']);
?>

</body>
</html>