<?php
$bannerType = 'tag';
if (isset($bannerConfig[$bannerType]['writeColumn'])) {
    $config = isset($bannerConfig[$bannerType]['writeColumn']) ? explode("|", $bannerConfig[$bannerType]['writeColumn']) : null;
    $dbData = getBannerData($config, $bannerType);

    if (count($dbData) == 0) return;
    // 검색 페이지 menu_id값 구하기
    $query = "SELECT menu_id FROM " . MENU_TABLE . " WHERE site = '" . SITE_NAME . "' AND route = 'search'";

    $searchDBData = $DB->getDBData($query);
    $search_menu_id = intval($searchDBData[0]['menu_id']);
    ?>

<div class="searchLnb">
			
	<ul>
    	<?php foreach($dbData as $tag){?>
    	<li><a href="search.php?menu=<?=$search_menu_id?>&keyword=<?=urlencode($tag['title'])?>"><?=$tag['title']?></a></li>
    	<?php }?>
	</ul>
</div>
<?php }?>