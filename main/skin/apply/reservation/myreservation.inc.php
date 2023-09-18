<div class="myreservbox">
	<h4 class="title">
		<?=$system['site']['author']?><br> 
		<strong>나의 예약현황 보기</strong>
	</h4>
	
	<div class="myreservbtn">
		<a href="<?=getBackUrl("menu|pno|limit|category")?>">시설예약하기</a>
	</div>
	
	<?php if(!$userID){?>
	<div class="myreservbg">
		
		<form action="<?=SKIN_URL?>myreservation.php" autocomplete="off" method="post">
			<fieldset>
				<legend>로그인항목</legend>
				<span class="myreservform">
    				<p><span>담당자(신청자)명</span> / <span>비밀번호</span>를 입력하세요.</p> 
    				<input name="uname" type="text" id="uname" title="이름" placeholder="이름" />
    				<input name="upw" type="password" id="upw" title="비밀번호" placeholder="비밀번호" />
    				
				</span>
				<input type="hidden" name="backUrl" value="<?=getBackUrl("menu|mode|pno|category|limit|sfv|opt", 1)?>" />
				<input type="hidden" name="menu" value="<?=$menuID?>" />
				<input class="loginbt" type="submit" title="조회" value="조회" />
			</fieldset>
		</form>
	</div>
	<?php }?>
	
	<?php if($auth){?>
	<div class="list-contents">
	
		<div class="list-table">       
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
    				<col width="20%">
    				<col width="20%">
                    <col width="30%">
                    <col width="10%">
                    <col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>시설명</th>
						<th>예약시간</th>
						<th>예약상태</th>
						<th>상세보기</th>
						<th>예약취소</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($system['data']['reservationData'] as $value){?>
					<tr>
						<td>
							<div><?=$value['subject']?></div>
							<div class="mcol"><?=$value['reservation_time_info']?></div>
							<div class="mcol"><?=$value['reservation_state'] == 1 ? "승인" : "미승인"?></div>
						</td>					
						<td class="pcol"><?=$value['reservation_time_info']?></td>					
						<td class="pcol"><?=$value['reservation_state'] == 1 ? "승인" : "미승인"?></td>
						
						<td><a href="<?=SKIN_URL?>myreservation_info.ajax.php?no=<?=$value['indexcode']?>" rel="modal:open" class="listbox-more view_reservation">상세보기</a></td>	
						<td><a href="<?=SKIN_URL?>apply_delete.php?no=<?=$value['indexcode']?>&backUrl=<?=urlencode(getBackUrl('menu|mode', 1))?>" class="listbox-del cancel_reservation">예약취소</a></td>				
					</tr>
					<?php }?>
					<?php if(count($system['data']['reservationData']) == 0){?>
					<tr>
						<td colspan="5">예약신청 내역이 없습니다.</td>
					</tr>
					<?php }?>
				</tbody>
            </table>
		</div>
		
		
	</div>
	<?php }?>
	
</div>

    