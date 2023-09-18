<form action="<?=SKIN_URL?>site_change.php" method="post" id="site_form">
	<table class="table_basic">
    	<colgroup>
    		<col width="10%"/>
    		<col width="20%"/>
    		<col width="10%"/>
    		<col width="40%"/>
    		<col width="20%"/>
    	</colgroup>
		<tbody>
			<tr>
				<th><label for="site">사이트 선택</label></th>
				<td class="tleft">
					<select name="site" id="site">
					<?php 
					foreach($system['siteList'] as $key => $value){
						
						if($key == "innerCMS") continue;
					?>
					<option value="<?php echo $key?>" <?php echo isselected($siteKey, $key)?>><?php echo $value['author']?></option>
					<?php }?>
					</select>
					<input type="hidden" name="backUrl" value=<?php echo getBackUrl('menu|pno|limit|order', 1)?> />
				</td>
				<th>정렬</th>
				<td>
					<?php foreach($orderList as $key => $value){?>
					<a href="<?php echo getBackUrl('menu|pno|limit|site')?>&order=<?php echo $key?>" class="btn <?php if($order == $key){?>btn_view<?php }?>" style="border:1px solid #ccc"><?php echo $orderList[$key]?>순</a>
					<?php }?>
				</td>
				<td><a href="<?php echo getBackUrl('menu|pno|limit|site')?>&mode=complain_list" class="btn btn-default">의견 모아보기</a></td>
			</tr>
		</tbody>
	</table>
</form>

<table class="table_basic mt20">
	<caption><?php echo $orderList[$order]?>순 리스트</caption>
	<colgroup>
		<col width="5%"/>
		<col width="5%"/>
		<col width="5%"/>
		<col width="85%"/>
	</colgroup>
	<thead>
		<tr>
			<th>전체 의견수</th>
			<th>오늘 의견수</th>
			<th>평균점수</th>
			<th>메뉴명</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			
			switch($order)
			{
				case "menu" :
					$CP->getMenuOrderList();
					break;
				
				case "total" :
					$CP->getTotalOrderList();
					break;
					
				case "today" :
					$CP->getTodayOrderList();
					break;
					
				default :
					break;
			}
			
		?>
		</tbody>
</table>





