<?php 
$dbData = $system['data']['dbData'];
$reservationData = $system['data']['reservationData'];
?>

<table class="table_basic mt50">
	<caption>예약정보</caption>
	<colgroup>
		<col width="10%"/>
		<col width="23%"/>
		<col width="10%"/>
		<col width="23%"/>
		<col width="10%"/>
		<col width="23%"/>
		
		
	</colgroup>
	<tbody>
	
		<tr>
			<th>예약시설명</th>
			<td colspan="3" class="tleft">
				<?=$dbData['subject']?>
			</td>
			<th>승인여부</th>
			<td class="tleft">
			<?php if($reservationData['reservation_state'] == 0){?>
				<a href="<?=SKIN_URL?>status_change.php?no=<?php echo $reservationData['indexcode']?>&state=1&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|sno|view|pno|category|limit|sfv", 1))?>" data-name="<?=$reservationData['uname']?>" data-status="승인" class="in_btn btn_off apply_change">미승인</a>
				<?php }else if($reservationData['reservation_state'] == 1){?>
				<a href="<?=SKIN_URL?>status_change.php?no=<?php echo $reservationData['indexcode']?>&state=0&backUrl=<?=base64_encode(getBackUrl("menu|mode|no|sno|view|pno|category|limit|sfv", 1))?>" data-name="<?=$reservationData['uname']?>" data-status="미승인" class="in_btn btn_on apply_change">승인</a>
				<?php }?>
			</td>
		</tr>
		<tr>
			<th>예약시간</th>
			<td colspan="3" class="tleft">
				<?=$reservationData['reservation_time_info']?>
			</td>
			<th>예약금액</th>
			<td class="tleft"><?=number_format($reservationData['reservation_fee'])?>원</td>
		</tr>
		
		<tr>
			<th>담당자(신청자) 이름</th>
			<td class="tleft">
				<?=$reservationData['uname']?>
			</td>
			<th>담당자(신청자) 휴대폰</th>
			<td class="tleft">
				<?=$reservationData['mobile']?>
			</td>
			<th>담당자(신청자) 전화</th>
			<td class="tleft">
				<?=$reservationData['phone']?>
			</td>
		</tr>
		<tr>
			<th>담당자(신청자) 이메일</th>
			<td class="tleft">
				<?=$reservationData['email']?>
			</td>
		
			<th>사용목적</th>
			<td class="tleft">
				<?=$reservationData['use_purpose']?>
			</td>
			<th>사용인원 </th>
			<td class="tleft">
				<?=$reservationData['use_people']?>명
			</td>
		</tr>
		<tr>
			<th>신청단체명</th>
			<td class="tleft">
				<?=$reservationData['group_name']?>
			</td>
			<th>대표자 성명</th>
			<td class="tleft">
				<?=$reservationData['ceo_name']?>
			</td>
			<th>사업자등록번호</th>
			<td class="tleft">
				<?=$reservationData['biz_num']?>
			</td>
		</tr>
		<tr>
			<th>주소</th>
			<td colspan="3" class="tleft">
				<?=$reservationData['zipcode']?>
				<?=$reservationData['address']?>
				<?=$reservationData['address2']?>
			</td>
			<th>신청경로</th>
			<td class="tleft"><?=$reservationData['apply_route']?></td>
		</tr>
		<tr>
			<th>전달(문의)사항</th>
			<td colspan="5" class="tleft"><?=nl2br($reservationData['etc'])?></td>
		</tr>
		
	</tbody>
</table>

<div class="function mt30">
	<a href="<?=getBackUrl("menu|no|pno|category|limit|sfv|opt")?>&amp;mode=reservation_list" class="btn btn-default">뒤로</a>
	<a href="<?=SKIN_URL?>apply_delete.php?menu=<?=$menuID?>&amp;no=<?php echo $reservationData['indexcode']?>&backUrl=<?=base64_encode(getBackUrl("menu|no|view|pno|category|limit|sfv", 1)."&mode=reservation_list")?>" class="btn btn_delete apply_delete">신청정보삭제</a>
</div>
