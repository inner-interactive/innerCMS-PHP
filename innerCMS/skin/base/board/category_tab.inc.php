<?php if($SKIN->categoryUse){?>
<div class="categoryTab">
	<ul class="tabs">
		<li<?php if($category == ""){?> class="active"<?php }?>><a href="<?=getBackUrl("menu|mode|limit|sfv|".$_GET['sfv']."|opt")?>" title="전체 카테고리로 보기">전체</a></li>
		<?php for($i = 0; $i < count($SKIN->categoryList); $i++){?>
		<li<?php if($category == trim($SKIN->categoryList[$i])){?> class="active"<?php }?>><a href="<?=getBackUrl("menu|mode|limit|sfv|".$_GET['sfv']."|opt")?>&amp;category=<?=urlencode($SKIN->categoryList[$i])?>" title="<?=$SKIN->categoryList[$i]?> 카테고리로 보기"><?=$SKIN->categoryList[$i]?></a></li>
		<?php }?>
	</ul>
</div>
<?php }?>