<div>
	<?php if(count($data)){?>
	<canvas id="myChart" style="width:100vw;height:<?=$vh?>vh"></canvas>
	<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'pie',
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
	            display: true
	          }
	    }
	});
	</script>
	<?php }?>
</div>

<div>
	<table class="table_basic th-g">
		<caption>OS별 접속자집계</caption>
		<colgroup>
			<col width="10%" />
			<col width="10%" />
			<col width="60%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">순위</th>
		        <th scope="col">OS</th>
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
			<td><?=$value['no']?></td>
			<td><?=$value['name'] ?></td>
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
		        <td colspan="3">합계</td>
		        <td><strong><?php echo $sum_count ?></strong></td>
		        <td>100%</td>
		    </tr>
	    </tfoot>
	</table>

</div>