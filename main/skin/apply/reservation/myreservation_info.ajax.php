<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";
$no = isset($_GET['no']) ? intval($_GET['no']) : 0;

$system['siteList'] = getSiteList();
$DB = new DB();
$RESERVATION = new FcReservation();


$check = $RESERVATION->myReservationCheck($no);

if($check){
    $reservationData = $RESERVATION->getReservationDataOne($no);
    $fcData = $RESERVATION->getFacilityDataOne($reservationData[0]['facode']);
    
?>
<div class="myreservinfo">
	<div class="reserv-detail">
		<div class="view-title">
			<span></span><?=$fcData[0]['subject']?>
		</div>
		<div class="view-subtitle">
			
		</div>
		<div class="view-list">
			<ul>
				<li><span class="bold">예약시간 :</span> <span><?=$reservationData[0]['reservation_time_info']?></span></li>
				<li><span class="bold">담당자(신청자)이름 : </span><span><?=$reservationData[0]['uname']?></span></li>
				<li><span class="bold">담당자(신청자)휴대폰 : </span><span><?=$reservationData[0]['mobile']?></span></li>
				<li><span class="bold">담당자(신청자)전화 : </span><span><?=$reservationData[0]['phone']?></span></li>
				<li><span class="bold">담당자(신청자)이메일 : </span><span><?=$reservationData[0]['email']?></span></li>
				<li><span class="bold">사용목적 : </span><span><?=$reservationData[0]['use_purpose']?></span></li>
				<li><span class="bold">사용인원 : </span><span><?=$reservationData[0]['use_people']?>명</span></li>
				<li><span class="bold">신청단체명 : </span><span><?=$reservationData[0]['group_name']?></span></li>
				<li><span class="bold">대표자성명	 : </span><span><?=$reservationData[0]['ceo_name']?></span></li>
				<li><span class="bold">사업자등록번호 : </span><span><?=$reservationData[0]['biz_num']?></span></li>
				<li><span class="bold">주소 : </span><span><?=$reservationData[0]['zipcode']?> <?=$reservationData[0]['address']?> <?=$reservationData[0]['address2']?></span></li>
				<li><span class="bold">전달(문의)사항	 : </span><span class="txt"><?=nl2br($reservationData[0]['etc'])?></span></li>
			</ul>
		</div>
		
    	
	</div>
	
	<div class="info-txt">
    	<div class="txt-box">
    		<div class="info-txt-title">안내사항</div>
    		<div class="info-txt-subtitle">신청이 완료되면 예약시설 담당자가 개별 연락하여 안내 후 승인처리를 합니다.<br>
    		<?=$system['siteList'][SITE_NAME]['author']?>을 통한 공연홍보방법으로는 인터넷 홈페이지 활용,건물외벽 현수막거재.회관내 포스터 부착 등이 있으며 세부사항은 담당자와 협의해 주시기 바랍니다.<br>
    		시설예약자는 성공적인 공연, 전시, 진행전반에 걸쳐 <?=$system['siteList'][SITE_NAME]['author']?>과 충분한 사전협의를 해주시기바랍니다.</div>    
    	</div>
    	<div class="totalp-box">
    		<div class="totalp-list">
    			<span class="totalp-title">총 예약금액</span> <span class="totalp-price"><?=number_format($reservationData[0]['reservation_fee'])?>원</span>
    		</div>
    		<div class="totalp-sub">( 대관희망일 최소 3일전까지 신청가능합니다. 부가세 10% 별도)</div>
    	</div>
	</div>
</div>

<?php }?>