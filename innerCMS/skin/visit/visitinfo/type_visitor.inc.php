<table class="table_basic th-g">
	<caption>접속자집계</caption>
	<colgroup>
		<col width="10%" />
		<col width="50%" />
		<col width="10%" />
		<col width="10%" />
		<col width="10%" />
		<col width="10%" />
	</colgroup>
	<thead>
		<tr>
			<th>IP</th>
			<th>접속 경로</th>
			<th>브라우저</th>
			<th>OS</th>
			<th>접속기기</th>
			<th>일시</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i = 0; $i < count($dbData); $i++){
	?>
	<tr<?php if($i % 2 == 0){?> class="highlight1"<?php }?>>
		<td><?=$dbData[$i]['vi_ip']?></td>
		<td><?=$dbData[$i]['vi_referer']?></td>
		<td><?=$dbData[$i]['vi_browser']?></td>
		<td><?=$dbData[$i]['vi_os']?></td>
		<td><?=$dbData[$i]['vi_device']?></td>
		<td><?=$dbData[$i]['vi_date']?> <?=$dbData[$i]['vi_time']?></td>
	</tr>
	<?php }?>
	<?php if(count($dbData) == 0){?>
	<tr>
		<td colspan="6">자료가 없습니다.</td>
	</tr>
	<?php }?>
	</tbody>
</table>
<?php include "pagination.inc.php"?>
