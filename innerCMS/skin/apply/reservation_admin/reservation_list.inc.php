<?php 
$dbData = $system['data']['dbData'];
$reservationData = $system['data']['reservationData'];
?>
<div class="function mt30">
	<a href="<?php echo getBackUrl("menu|sno|pno|category|limit|sfv|opt")?>" class="btn btn-default">목록</a>
</div>

<table class="table_basic mt50 th-g">
	<caption>신청자 정보 보기 (<?=$dbData['subject']?>)</caption>
	<thead>
    	<tr>
    		<th>번호</th>
    		<th>성명</th>
    		<th>휴대폰</th>
    		<th>이메일</th>
    		<th>예약시간</th>
    		<th>신청시간</th>
    		<th>상세정보보기</th>
    		<th>승인여부</th>
    		<th>신청내역삭제</th>
    	</tr>
	</thead>
	<tbody>
		<?php for($i = 0; $i < count($reservationData); $i++){
		    $_viewLink = getBackUrl("menu|no|pno|category|limit|sfv|opt")."&mode=reservation_view&sno=".$reservationData[$i]['indexcode'];
	    ?>
		<tr>
			<td><?php echo $i+1?></td>
			<td><a href="<?=$_viewLink?>"><?php echo $reservationData[$i]['uname']?></a></td>
			<td><?php echo $reservationData[$i]['mobile']?></td>
			<td><?php echo $reservationData[$i]['email'] != "" ? $reservationData[$i]['email'] : ""?></td>
			<td><?php echo $reservationData[$i]['reservation_time_info']?></td>
			<td><?php echo $reservationData[$i]['writetime']?></td>
			<td><a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a></td>
			<td>
				<?php if($reservationData[$i]['reservation_state'] == 0){?>
				<a href="<?=SKIN_URL?>status_change.php?no=<?php echo $reservationData[$i]['indexcode']?>&state=1&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|view|pno|category|limit|sfv", 1))?>" data-name="<?=$reservationData[$i]['uname']?>" data-status="승인" class="in_btn btn_off apply_change">미승인</a>
				<?php }else if($reservationData[$i]['reservation_state'] == 1){?>
				<a href="<?=SKIN_URL?>status_change.php?no=<?php echo $reservationData[$i]['indexcode']?>&state=0&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|view|pno|category|limit|sfv", 1))?>" data-name="<?=$reservationData[$i]['uname']?>" data-status="미승인" class="in_btn btn_on apply_change">승인</a>
				<?php }?>
			</td>
			<td>
				<a href="<?=SKIN_URL?>apply_delete.php?menu=<?=$menuID?>&amp;no=<?php echo $reservationData[$i]['indexcode']?>&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|view|pno|category|limit|sfv", 1))?>" class="in_btn apply_delete btn_delete">삭제</a>
			</td>
		</tr>
		<?php }?>
		
		<?php if(count($reservationData) == 0){?>
		<td colspan="11">신청내역이 없습니다.</td>
		<?php }?>
		
	</tbody>
</table>
<?php include "pagination.inc.php"?>

<div class="function mt30">
	<a href="<?php echo getBackUrl("menu|sno|pno|category|limit|sfv|opt")?>" class="btn btn-default">목록</a>
</div>