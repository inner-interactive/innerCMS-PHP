<div class="listbox-page">
    <ul>
    	<?php if($firstpage != -1){?>
    		<li class="prev"><a href="<?=getBackUrl("menu|no|sfv|".$_GET['sfv']."|mode|limit")?>&amp;pno=<?=$firstpage?>"title="첫페이지로 이동">처음</a></li>
    	<?php }?>
    	<?php if($prepage != -1){?>
    		<li class="prev"><a href="<?=getBackUrl("menu|no|sfv|".$_GET['sfv']."|mode|limit")?>&amp;pno=<?=$prepage?>" title="<?=$prepage?> 페이지로 이동">이전</a></li>
    	<?php }?>
    
    	<?php	for($i = $pagewidthstart; $i <= $pagewidthend; $i++){if($i == $pno){?>
    				<li class="on"><?=$i?></li>
    	<?php	}else{?>
    				<li><a href="<?=getBackUrl("menu|no|sfv|".$_GET['sfv']."|mode|limit|today")?>&amp;pno=<?=$i?>" title="<?=$i?> 페이지로 이동"><?=$i?></a></li>
    	<?php }} ?>
    
    	<?php if($nextpage != -1){?>
    		<li class="next"><a href="<?=getBackUrl("menu|no|sfv|".$_GET['sfv']."|mode|limit")?>&amp;pno=<?=$nextpage?>" class="next" title="<?=$nextpage?> 페이지로 이동">다음</a></li>
    	<?php }?>
    	<?php if($endpage != -1){?>
    		<li class="next"><a href="<?=getBackUrl("menu|no|sfv|".$_GET['sfv']."|mode|limit")?>&amp;pno=<?=$endpage?>" class="next" title="끝페이지로 이동">끝</a></li>
    	<?php }?>
    </ul>
</div>