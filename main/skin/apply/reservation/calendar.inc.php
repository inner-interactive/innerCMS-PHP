<div class="btn-box">
	<a href="<?=getBackUrl("menu|category|limit|sfv|opt|no")?>&mode=view">뒤로</a>
</div>
<?php if($reservation_use){?>
<form action="<?=SKIN_URL?>calendar.php" class="calendar_form" method="post">
    <div id="calendardiv" class="calendarbox">
    	<?=$RESERVATION->getCalendar($no)?>
    </div>
    
    <div class="day-apply"><input type="submit" class="day-apply-btn apply<?=$dbData[0]['reservation_type']?>" value="선택한 시간 예약 신청하기" /></div>
    <input type="hidden" name="backUrl" value="<?=getBackUrl("menu|category|limit|sfv|opt|no", 1)?>" />
    <input type="hidden" name="reservation_type" value="<?=$dbData[0]['reservation_type']?>" />
</form>
<?php }?>

