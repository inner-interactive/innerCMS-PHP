<?php 
$dbData = $system['data']['dbData'];
?>
<div class="leftnav">
	<div class="myreservbtn">
		<a href="<?=getBackUrl("menu|pno|limit|category")?>&amp;mode=myreservation">나의 예약현황보기</a>
	</div>
	<div class="leftbox">
		<div class="leftnav-title m01">시설별 담당자 연락처</div>
		<div class="moremenu">
			<div class="morebox">
				<?php for($i = 0; $i < count($dbData); $i++){
				    if($dbData[$i]['admin_name'] == "" && $dbData[$i]['admin_phone'] == "") continue;
			    ?>
				<div class="morebox-t"><?=$dbData[$i]['subject']?></div>
				<div class="morebox-s">
					<?=$dbData[$i]['admin_name'] != "" ? "<p>담당자 : " . $dbData[$i]['admin_name'] . "</p>" : ""?>
					<?=$dbData[$i]['admin_phone'] != "" ? "<p>전화 : " . $dbData[$i]['admin_phone'] . "</p>" : ""?>  
				</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="leftbox">
		<div class="leftnav-title m01">유의사항</div>
		<div class="moremenu">
			<div class="morebox">
				<div class="morebox-s">
					<p>대관시간은 09:00 ~ 18:00까지 운영되며, 야간 시설 사용시 문의 전화 협이 후 대관 가능합니다. 승인 완료 후에는 예약이 불가능 합니다.</p>
					<p>
						대관예약은 매달 1일부터 말일까지<br>가능하며 궁금한 사항은 공간별 담당자에게 문의하시면 됩니다.
					</p>
					<p>누에 아트홀의 경우 예약 신청 전 기획홍보팀(063-246-3951)과 문의 전화 후 신청바랍니다. 대관전시의 경우 전시지킴이는 대관주체에서 담당합니다.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="list-contents">

	<div class="list-total">
		<div class="list-view-w">
			<div class="list-total-view">
				<ul>
					<li class="view1"><a href="<?=getBackUrl("menu|pno|limit|category")?>&amp;list_type=thum"><img src="<?=SKIN_URL?>img/sub_list1<?=$list_type == 'thum' ? "_on" : ""?>.png" class="btn1"></a></li>
					<li class="view2"><a href="<?=getBackUrl("menu|pno|limit|category")?>&amp;list_type=list"><img src="<?=SKIN_URL?>img/sub_list2<?=$list_type == 'list' ? "_on" : ""?>.png" class="btn2"></a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<?php if($list_type == 'thum'){?>
	<div class="listboxw list-thum">
	
		<?php for($i = 0; $i < count($dbData); $i++){
		    $thumbData = $SKIN->getFileData(0, $dbData[$i]['indexcode'], 'reserv_thumb');	//리스트 섬네일
		    $_viewLink = getBackUrl("menu|pno|limit|category")."&amp;mode=view&amp;no=".$dbData[$i]['indexcode'];
	    ?>
		<div class="listbox">
			<div class="listbox-img">
				<div class="listbox-imgs">
					<a href="<?=$_viewLink?>" title="<?=$dbData[$i]['subject']?>">
					<?php if(count($thumbData) > 0){?>
					<img src="../data/upload/<?=$thumbData[0]['attach_file_name']?>" width="280px" height="168px" alt="<?=$dbData[$i]['subject']?> 섬네일 사진" />
					<?php }else{?>
					<img src="<?=SKIN_URL?>img/listimg_reserv.png" alt="<?=$dbData[$i]['subject']?> 섬네일 사진" />
					<?php }?>
					</a>
				</div>
				<div class="listbox-txt"><?=$dbData[$i]['subject']?></div>
			</div>
			<div class="listbox-subt">
				<div class="listbox-stitle"></div>
				<ul>
					<li><span>수용인원 : </span><?=$dbData[$i]['max_person']?></li>
					<li><span>장소위치 : </span><?=$dbData[$i]['location']?></li>
					<li><span>면적 : </span><?=$dbData[$i]['size']?></li>
				</ul>
				<div class="listbox-more"><a href="<?=$_viewLink?>">상세보기</a></div>
			</div>
		</div>
		<?php }?>
	</div>
	<?php }else if($list_type == 'list'){?>
	
	<!--list-->
	<div class="listboxw list-table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<colgroup>
				<col width="40%">
				<col width="20%">
				<col width="20%">
				<col width="20%">
			</colgroup>
			
			<thead>
				<tr>
					<th>시설명</th>
					<th>장소위치</th>
					<th>문의전화</th>
					<th>상태</th>
				</tr>
			</thead>
			<tbody>
    			<?php 
    			for($i = 0; $i < count($dbData); $i++){
    		    $thumbData = $SKIN->getFileData(0, $dbData[$i]['indexcode'], 'reserv_thumb');	//리스트 섬네일
    		    $_viewLink = getBackUrl("menu|pno|limit|category")."&amp;mode=view&amp;no=".$dbData[$i]['indexcode'];
                ?>
				<tr>
					<td><?=$dbData[$i]['subject']?></td>
					<td><?=$dbData[$i]['location']?></td>
					<td><?=$dbData[$i]['admin_phone']?></td>
					<td>
						<a class="listbox-more" href="<?=$_viewLink?>">상세보기</a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php }?>
	
	<?php include "pagination.inc.php"?>
	
</div>


