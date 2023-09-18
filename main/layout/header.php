<!doctype html>
<html lang="ko">
<head>

<!-- Page Title -->
<?php
$head_title = isset($system['data']['menu']['menu_title']) ?  trim($system['data']['menu']['menu_title']) : "";
?>
<title><?=$head_title?><?if($head_title !=""){?> | <?}?><?=$system['site']['author']?></title>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="telephone=no" />

<meta name="robots" content="index, follow" />

<meta name="author" content="<?=$system['site']['author']?>" />
<meta name="description" content="<?=$system['site']['description']?>" />
<meta name="keywords" content="<?=$system['site']['keyword']?>" />

<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$system['site']['author']?> <?=$head_title?>" />
<meta property="og:description" content="<?=$system['site']['description']?>" />
<meta property="og:image" content="img/logo.gif" />
<meta property="og:url" content="<?=BASE_URL?>" />

<link rel="shortcut icon" href="img/logo.gif" />
<link rel="apple-touch-icon" href="img/logo.gif" />
<link rel="apple-touch-icon-precomposed" href="img/logo.gif" />


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

	<!-- 상단배너 -->
<?php include 'banner/top.inc.php'?>
<!-- 상단배너끝 -->

	<header class="header">

		<div class="header-nav-wrapper">
			<div class="container w1400">
				<div class="topgnb">
					<span><a href="./">HOME</a></span> 
					<?php if(!$userID){?>
					<span><a href="route.php?action=login&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE, 1))?>">LOGIN</a></span>
					<span><a href="route.php?action=join&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE, 1))?>">JOIN</a></span>
					<?php }else{?>
					<span><a href="route.php?action=logout&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE))?>">LOGOUT</a></span>
					<?php }?>
    				<?php if($isAdmin){?>
    				<span><a href="../innerCMS/">ADMIN</a></span>
    				<?php }?>
			</div>
				<h1 class="logo">
					<a href="./" title="메인 페이지로 이동"> <img src="img/logo.gif" alt="<?=$system['site']['author']?> 로고" />
					</a>
				</h1>
				<div class="gnb-area">
				<?=$system['menu']['gnb']?>
				<div class="togglebar">
						<a href="#" class="searchAll search_open"><img src="img/search-w.png" alt="검색" /></a>
					</div>
					<div>
						<a href="#" class="fmSitBt"><span></span></a>
					</div>
				</div>
			</div>
		</div>

		<!--m-->
		<div id="hamburger">
			<div class="hamburger_inner">
				<div class="mmain-top">
					<div class="util-search togglebar m-search">
						<a href="#none" class="search search_open">검색</a>
					</div>
					<h1>
						<a href="./">
							<p>
								<img src="img/logo.gif" alt="<?=$system['site']['author']?> 로고" />
							</p>
						</a>
					</h1>
					<a href="#" class="close"><img src="img/mmenuclose.png" alt="메뉴 닫기 버튼" /></a>
				</div>
				<div class="mlogin">
				
					<?php if(!$userID){?>
					<span><a href="route.php?action=login&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE, 1))?>">LOGIN</a></span>
					<span><a href="route.php?action=join&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE, 1))?>">JOIN</a></span>
					<?php }else{?>
					<span><a href="route.php?action=logout&backUrl=<?=urlencode(getBackUrl(BACKURL_VALUE))?>">LOGOUT</a></span>
					<?php }?>
    				<?php if($isAdmin){?>
    				<span><a href="../innerCMS/">ADMIN</a></span>
    				<?php }?>
				</div>
			</div>
		<?php echo $system['menu']['mobile_menu'] ?> 
	</div>
		<div class="mmain-top">
			<div class="util-search togglebar m-search">
				<a href="#none" class="search search_open">검색</a>
			</div>
			<h1>
				<a href="./">
					<p>
						<img src="img/logo.gif" alt="<?=$system['site']['author']?> 로고" />
					</p>
				</a>
			</h1>
			<nav>
				<a href="#" class="hamburger"><img src="img/mmenu.png" alt="메뉴 열기 버튼" /></a>
			</nav>
		</div>
		<!--m-->
	</header>


<?php include "search.inc.php"; ?>
