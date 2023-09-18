<table class="table_basic th-g">
	<caption>사이트 리스트</caption>
	<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">DIRECTORY</th>
			<th scope="col">사이트 이름</th>
			<th scope="col">생성일</th>
			<th scope="col">메뉴정보</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$i = 0;
		foreach($system['siteList'] as $site_key => $value){
	    ?>
		<tr>
			<td scope="row"><?=$i+1?></td>
			<td><a href="<?=getBackUrl("menu")?>&amp;mode=list&amp;site=<?=$site_key?>"><strong><?=$site_key?></strong></a></td>
			<td><?=$value['author']?></td>
			<td><?=$value['build']?></td>
			<td><a href="#" target="_blank"><?=$site_key?></a></td>
		</tr>
		<?php 
		$i++;
		}?>
	</tbody>
</table>