<ul class="tabs">
	<?php foreach($contentsType as $value){?>
	<li<?=$type == $value ? " class=\"active\"" : "" ?>><a href="<?php echo getBackUrl('menu|mode|site')?>&type=<?=$value?>"><?=$value?></a></li>
	<?php }?>
</ul>

<div class="function mt20">
	<a href="<?php echo getBackUrl('menu')?>" class="btn btn btn-default">뒤로</a>
</div>


<div>
	<table class="table_basic">
		<caption>콘텐츠 리스트</caption>
		<tbody>
			<?php foreach($dirContents as $value){?>
			<tr>
				<td class="tleft"><a href="<?php echo getBackUrl('menu|mode|site|type')?>&mode=update&file=<?=urlencode($value)?>"><?=$value?></a></td>
			</tr>
			<?php }?>
			
		</tbody>
	</table>
</div>
<div class="function mt20">
	<a href="<?php echo getBackUrl('menu')?>" class="btn btn btn-default">뒤로</a>
</div>
