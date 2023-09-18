<div class="pagination">
	<?php if($firstpage != -1){?>
		<a href="<?=getBackUrl("menu|site|fr_date|to_date|domain")?>&amp;pno=<?=$firstpage?>" class="direction first" title="첫페이지로 이동">처음</a>
	<?php }?>
	<?php if($prepage != -1){?>
		<a href="<?=getBackUrl("menu|site|fr_date|to_date|domain")?>&amp;pno=<?=$prepage?>" class="direction prev" title="<?=$prepage?> 페이지로 이동">이전</a>
	<?php }?>

	<?php	for($i = $pagewidthstart; $i <= $pagewidthend; $i++){if($i == $pno){?>
				<span class="on"><?=$i?></span>
	<?php	}else{?>
				<a href="<?=getBackUrl("menu|site|fr_date|to_date|domain")?>&amp;pno=<?=$i?>" title="<?=$i?> 페이지로 이동"><?=$i?></a>
	<?php }} ?>

	<?php if($nextpage != -1){?>
		<a href="<?=getBackUrl("menu|site|fr_date|to_date|domain")?>&amp;pno=<?=$nextpage?>" class="direction next" title="<?=$nextpage?> 페이지로 이동">다음</a>
	<?php }?>
	<?php if($endpage != -1){?>
		<a href="<?=getBackUrl("menu|site|fr_date|to_date|domain")?>&amp;pno=<?=$endpage?>" class="direction end" title="끝페이지로 이동">끝</a>
	<?php }?>
</div>