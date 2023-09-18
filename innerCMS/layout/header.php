<!doctype html>
<html>
<head>

<!-- Page Title -->
<?php 
$head_title = isset($system['data']['menu']['menu_title']) ? trim($system['data']['menu']['menu_title']) : "";
?>
<title><?=$head_title?><?if($head_title !=""){?> | <?}?><?=$system['site']['author']?></title>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="telephone=no" />

<meta name="robots" content="NOINDEX, NOFOLLOW" />
<meta name="author" content="<?=$system['site']['author']?>" />
<meta name="description" content="<?=$system['site']['description']?>" />
<meta name="keywords" content="<?=$system['site']['keyword']?>" />

<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$system['site']['author']?> <?=$head_title?><?if($head_title !=""){?><?}?>" />
<meta property="og:description" content="<?=$system['site']['description']?>"  />
<!-- 
<meta property="og:image" content="https://<?=$_SERVER['SERVER_NAME']?>/main/img/images/kakao_wfac_logo.png" />
<meta property="og:url" content="https://<?=$_SERVER['SERVER_NAME']?>" />
 -->

<!-- 
<link rel="shortcut icon" href="img/favicon_logo.png" />
<link rel="apple-touch-icon" href="img/favicon_logo.png" />
<link rel="apple-touch-icon-precomposed" href="img/favicon_logo.png" />
 -->
 
<script type="text/javascript">
const menuID = <?=$menuID?>;
const headTitle = '<?=$head_title?>';
const fullUrl = '<?=urlencode($full_url)?>';
<?php if(isset($system['data']['menu']['menu_type']) && $system['data']['menu']['menu_type'] == "skin"){?>
const skinUrl = '<?=SKIN_URL?>';
<?php }?>
const backUrl = '<?=getBackUrl(BACKURL_VALUE, 1)?>';
const userID = '<?=$userID?>';
</script>
 
 

<?php
if(isset($system['jscss']['css'])) setLinkTagArray($system['jscss']['css']);
if(isset($system['jscss']['css_skin'])) setLinkTagArray($system['jscss']['css_skin']);
?>

<?php 
if(isset($system['jscss']['prejs'])) setScriptTagArray($system['jscss']['prejs']);
if(isset($system['jscss']['prejs_skin'])) setScriptTagArray($system['jscss']['prejs_skin']);
?>


</head>
<body>



	<?php if($login_menuID != $menuID){?>
	<h1><?=$head_title?></h1>

	<!-- 스킵 네비게이션S -->
	<div class="Skipul">
		<h2>리뷰 네비게이션</h2>
		<ul>
			<li><a href="#gnb" title="메뉴로 바로 가기" class="skip">메뉴로 다시가기</a></li>
			<li><a href="#contwrap" title="본문으로 바로가기" class="skip">본문으로 다시가기</a></li>
			<li><a href="#footer" title="연락처 및 저작권으로 바로가기" class="skip">연락처 및 저작권으로 다시가기</a></li>
		</ul>
	</div>
	<!-- 스킵 네비게이션E -->

	<header id="header">

		<div class="topmenu">
			<h2>상단메뉴</h2>
			<ul class="houseTop">
				<?if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){?>
				<li><b><?=$_SESSION["user_uname"]?></b> 님 (<?php echo $_SESSION['user_id']?>)</li>
				<li><a href="route.php?action=logout" title="Logout">Logout</a></li>
				<?}else{?>
				<li><a href="route.php?action=login&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE , 1, 1))?>" title="Login">Login</a></li>
				<?}?>
				<li>
					<a href="../main/" title="사이트로 이동">사이트로</a>
				</li>
				<li class="cs">
					<a href="http://cs.inner515.co.kr/" target="_blank" title="이너인터랙티브 고객센터로 이동">이너고객센터</a>
				</li>
			</ul>
		</div>

		<h2>상단로고</h2>
		<ul class="houselogomenuTop">
			<li class="logo"><a href="./" title="메인으로 이동" ><?=$system['site']['author']?></a></li>
			<li class="menulist">
				<h2>메인메뉴</h2>
					<?=$system['menu']['gnb']?>
			</li>
		</ul>

	</header>
	<?php }?>
