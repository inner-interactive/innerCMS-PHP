<div class="function mt30">
	<ul class="tabs">
	<?php foreach($system['siteList'] as $key => $value){
	    if($key == "innerCMS") continue;
    ?>
	<li<?php if($PAGEVIEW->siteKey == $key){?> class="active"<?php }?>><a href="<?=getBackUrl("menu|view")?>&amp;site=<?=$key?>"><?=$value['author']?></a></li>
	<?php }?>
	</ul>
</div>


<table class="table_basic th-g">
	<caption>페이지뷰</caption>
	<colgroup>
		<col width="20%">
		<col width="60%">
		<col width="10%">
		<col width="10%">
	</colgroup>
	<thead>
		<tr>
			<th>메뉴</th>
			<th>그래프</th>
			<th>비율</th>
			<th>조회수</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		foreach($menuList as $value) {
			$menu_html = $MENU->makePositionHtml($MENU->getPositionArray($value['menu_id']), 1);
			if($menu_html == "")
				$menu_html = "메인";
			?>
		<tr<?php if($i % 2 == 0){?> class="highlight1"<?php }?>>
			<td><?=$menu_html?></td>
			<td>
				<div class="visit_bar">
					<span style="width: <?=$value['percent']?>%"> </span>
				</div>
			</td>
			<td><?=$value['percent']?>%</td>
			<td><?=$value['count']?></td>
		</tr>
		<?php
		$i++;
		}?>
	</tbody>
</table>