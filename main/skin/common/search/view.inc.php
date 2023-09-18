<ul class="allsearch skin_search">
	<li><span class="searchload"> <?=$MENU->makePositionHtml($MENU->getPositionArray($smenu))?> [<strong><?=$system['data']['dbDataTotal']?></strong>]
	</span> <span class="searchresult">
			<ul>
				<?php
    $dbData = $system['data']['dbData'];
    for ($i = 0; $i < count($dbData); $i ++) {
        $_link = "./?menu=" . $smenu . "&amp;mode=view&amp;no=" . $dbData[$i]['indexcode'];
        $fileData = $SKIN->getFileData($smenu, $dbData[$i]['indexcode'], 'thumb');
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
						<a class="title" href="<?=$_link?>" target="_blank"><?=strcut($dbData[$i]['subject'], 50)?></a>
						<a class="contents" href="<?=$_link?>" target="_blank"><?=strcut_for_keyword($dbData[$i]['memo'], $keyword)?></a>
					</div>
				</li>
				<?php }?>
			</ul>
	</span></li>
</ul>
<div class="btnbox">
	<a href="<?=getBackUrl("menu|category|limit|opt|sf|keyword|type")?>"
		class="btn btn-default">뒤로</a>
</div>
<?php include "pagination.inc.php"?>
