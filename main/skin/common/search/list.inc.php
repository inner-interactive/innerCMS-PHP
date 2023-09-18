<? include "search.inc.php" ?>


<div class="div_title">
	<ul>
		<?php foreach($search_type_array as $key => $value){?>
		<li <?php if($menuType == $key){?> class="dt_on" <?php }?>><a
			href="<?=getBackUrl("menu|mode|category|limit|opt|sf|keyword")?>&amp;type=<?=$key?>"><?=$value?> (<?php echo $search_count[$key]?>)</a></li>
		<?php }?>
	</ul>
</div>
<?php if($menuType == 'contents' || $menuType == 'all'){?>
<ul class="allsearch">
	<?php

for ($i = 0; $i < count($contentsInfo); $i ++) {
        if ($contentsInfo[$i]['text']) {
?>
		<li>
    		<span class="searchload"> 
    			<a href="./?menu=<?=$contentsInfo[$i]['menu_id']?>" target="_blank"><?=$MENU->makePositionHtml($MENU->getPositionArray($contentsInfo[$i]['menu_id']))?></a>
    		</span> 
    		<span class="searchresult">
    			<ul>
    				<li><a href="./?menu=<?=$contentsInfo[$i]['menu_id']?>" target="_blank"><?php echo $contentsInfo[$i]['text']?></a>
    				</li>
    			</ul>
    		</span>
		</li>
		<?php
        }
    }
    ?>
</ul>
<?php }?>

<?php if($menuType == 'skin' || $menuType == 'all'){?>
<ul class="allsearch skin_search">

	<?php
    // 검색 키워드가 들어가 있는 카테고리 표시
    for ($i = 0; $i < count($skinInfo); $i ++) {
        if ($skinInfo[$i]['total'] != 0) {
            ?>
	<li><span class="searchload">
			<?=$MENU->makePositionHtml($MENU->getPositionArray($skinInfo[$i]['menu_id']))?>
			 (<?=$skinInfo[$i]['total']?>)
				<div class="more">
				<a title="상세 검색 결과보기"
					href="<?=getBackUrl("menu|mode|category|limit|opt|sf|keyword")?>&amp;mode=view&amp;smenu=<?=$skinInfo[$i]['menu_id']?>"
					class="btnmore"> <span class="expansion">상세 검색 결과보기</span> <span
					class="reduction"></span>
				</a>
			</div>
	</span> <span class="searchresult">
			<ul>
			<? 
// 카테고리 안의 세부 내용 표시

            $list_num = ($skinInfo[$i]['total'] < $list_default_num) ? $skinInfo[$i]['total'] : $list_default_num;
            for ($j = 0; $j < $list_num; $j ++) {
                $_link = "./?menu=" . $skinInfo[$i]['menu_id'] . "&amp;mode=view&amp;no=" . $skinInfo[$i]['dbData'][$j]['indexcode'];
                $fileData = $SKIN->getFileData($skinInfo[$i]['menu_id'], $skinInfo[$i]['dbData'][$j]['indexcode'], 'thumb');
                if (count($fileData) > 0) {
                    $_src = "../data/upload/" . $fileData[0]['attach_file_name'];
                } else {
                    $_src = "img/skin/noimg.png";
                }
                ?>
				<li>
					<div class="thumb">
						<a href="<?=$_link?>" target="_blank"><img src="<?=$_src?>" alt="" /></a>
					</div>
					<div class="text">
						<a class="title" href="<?=$_link?>" target="_blank"><?=strcut($skinInfo[$i]['dbData'][$j]['subject'], 50)?></a>
						<a class="contents" href="<?=$_link?>" target="_blank"><?=strcut_for_keyword($skinInfo[$i]['dbData'][$j]['memo'], $keyword)?></a>
					</div>
				</li>
				
			<?}?>
			</ul>
	</span></li>
	<?}?>
<?}?>
</ul>
<?php }?>

<?if($search_count['all'] == 0){?>
<ul>
	<li><span class="searchload"></span> <span class="searchresult">
			<ul>
				<li class="nosearch">검색 조건에 해당하는 게시물이 존재하지 않습니다.</li>
			</ul>
	</span></li>
</ul>
<?}?>


