<div>
	<?php if(count($data)){?>
	<canvas id="myChart" style="width:100vw;height:<?=$vh?>vh"></canvas>
	<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'horizontalBar',
	    data:{ 
	        
	        labels: [<?=$labels?>],
	        datasets: [
	                   
	                   {
	           			label : '접속자수',
			            data: [<?=$datas?>],
			            backgroundColor: colors.sort(function(){return Math.random() - Math.random();}),
			            borderWidth: 0
			        	}
// 	                   ,{
// 	           			label : '비율',
//			            data: [<?=$rates?>],
// 			            backgroundColor: colors.sort(function(){return Math.random() - Math.random();}),
// 			            borderWidth: 0
// 			        	}
			        	
	                   ]
	    }
	    ,
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        },
	        legend: {
	            display: false
	        }
	    }
	});
	</script>
	<?php }?>
</div>
<div>
	<table class="table_basic th-g">
		<caption>일별 접속자집계</caption>
		<colgroup>
			<col width="10%" />
			<col width="70%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">년-월-일</th>
		        <th scope="col">그래프</th>
		        <th scope="col">접속자수</th>
		        <th scope="col">비율(%)</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(count($data)){
			foreach($data as $key => $value){
		?>
		
		<tr<?php if($key % 2 == 0){?> class="highlight1"<?php }?>>
			<td><a href="<?=SKIN_URL?>search.php?fr_date=<?=$value['name']?>&amp;to_date=<?=$value['name']?>&amp;type=visitor"><?=$value['name'] ?></a></td>
			<td>
				 <div class="visit_bar">
	                <span style="width:<?php echo $value['rate'] ?>%"></span>
	            </div>
			</td>
			<td><?=$value['count']?></td>
			<td><?=$value['rate']?></td>
		</tr>
		<?php }?>
		
		
		<?php }else{?>
		<tr>
			<td colspan="6">자료가 없습니다.</td>
		</tr>
		<?php }?>
		</tbody>
		<tfoot>
		    <tr style="background:#eaeaea;">
		        <td colspan="2">합계</td>
		        <td><strong><?php echo number_format($sum_count) ?></strong></td>
		        <td>100%</td>
		    </tr>
	    </tfoot>
	</table>

</div>