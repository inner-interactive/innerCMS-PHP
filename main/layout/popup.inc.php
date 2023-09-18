<?php
$popup_orderby = " ORDER BY writetime DESC, pop_id DESC";

// 팝업 게시물 가져오기
$query = "SELECT * FROM " . POPUP_TABLE . " WHERE site = '" . SITE_NAME . "' AND pop_type = 'popup' AND isstop = 0  AND start_date <='" . TIME_YMD . "' AND end_date >= '" . TIME_YMD . "' " . $popup_orderby;
$popupData = $DB->getDBData($query);

$query = "SELECT * FROM " . POPUP_TABLE . " WHERE site = '" . SITE_NAME . "' AND pop_type = 'layer' AND isstop = 0  AND start_date <='" . TIME_YMD . "' AND end_date >= '" . TIME_YMD . "' " . $popup_orderby;
$layerData = $DB->getDBData($query);

$query = "SELECT * FROM " . POPUP_TABLE . " WHERE site = '" . SITE_NAME . "' AND pop_type = 'intro' AND isstop = 0  AND start_date <='" . TIME_YMD . "' AND end_date >= '" . TIME_YMD . "' " . $popup_orderby;
$introData = $DB->getDBData($query);

?>
<script type="text/javascript">
jQuery(function($){


	function windowopen(url, width, height, left, top, no){
		win = window.open(url, "win"+no, "width="+width+", height="+height+", left="+left+", top="+top+", toolbar=no,location=0, directories=0,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no");	
	}


	function getCookie( name ){ 
		var nameOfCookie = name + "="; 
		var x = 0; 

		while ( x <= document.cookie.length ){ 
                var y = (x+nameOfCookie.length); 
                if( document.cookie.substring( x, y ) == nameOfCookie ) {				
                        if( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) 
                                endOfCookie = document.cookie.length; 

                        return unescape( document.cookie.substring( y, endOfCookie ) ); 
				} 

				x = document.cookie.indexOf( " ", x ) + 1; 

				if( x == 0 ) 
					break; 
		}
		return ""; 

	} 




<?php

for ($i = 0; $i < count($popupData); $i ++) {

    $no = intval($popupData[$i]['pop_id']);
    $url = "popupview.php?no=" . $no;
    $memo = $popupData[$i]['memo'];
    $subject = $popupData[$i]['subject'];

    $width = intval($popupData[$i]['width']);
    $height = intval($popupData[$i]['height']);

    $top = intval($popupData[$i]['top']);
    $left = intval($popupData[$i]['left']);

    ?>

	if( getCookie( "Popup<?=$no?>" ) != "done" ) { 
		var Popup<?=$no?> = windowopen("<?=$url?>", <?=$width?>, <?=$height?>, <?=$left?>, <?=$top?>, <?=$no?>);  
	}

<?php
}
?>


	function popup_setCookie( name, value, expiredays )
	{
		var todayDate = new Date();
		todayDate.setDate( todayDate.getDate() + expiredays );
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}

	//레이어팝업
	
	$('.popclose, .topclose').click(function() {

		var id = $(this).closest('.popup').attr('id');
		$('#' + id).hide();

		not_today = $(this).closest('.popup').find('.not_today').attr('checked');
		if(not_today == 'checked'){
			popup_setCookie(id , "done" , 1); // 1=하룻동안 공지창 열지 않음
		}
		return false;
	});
	
});

</script>

<!-- 레이어팝업 -->
<div id="poplayer">
	<h2>레이어팝업 알림</h2>
	<?php
for ($i = 0; $i < count($layerData); $i ++) {
    $_id = intval($layerData[$i]['pop_id']);
    if (isset($_COOKIE['pop_' . $_id]) && $_COOKIE['pop_' . $_id] == "done")
        continue;

    $memo = $layerData[$i]['memo'];
    $subject = $layerData[$i]['subject'];

    $width = intval($layerData[$i]['width']);
    $height = intval($layerData[$i]['height']);

    $top = intval($layerData[$i]['top']);
    $left = intval($layerData[$i]['left']);
    $not_today = intval($layerData[$i]['not_today']);
    $subject_display = intval($layerData[$i]['subject_display']);

    ?>
	<div id="pop_<?=$_id?>" class="popup" style="top:<?=$top?>px;left:<?=$left?>px;width:<?=$width?>px">
		<?php if($subject_display){?>
		<div class="popheader"><?=$subject?></div>
		<div class="topclose">
			<img src="img/main/pop_close.png" alt="닫기" />
		</div>
		<?php }?>
        <div class="popcontents" style="width:<?=$width?>px;height:<?=$height?>px">
            <?php echo htmlspecialchars_decode($memo); ?>
        </div>
		<?php if($not_today){?>
        <div class="popfooter">
			<input type="checkbox" id="popclose<?=$_id?>" class="not_today" /> <label
				for="popclose<?=$_id?>">오늘은 이창을 다시 열지 않음</label>
			<button class="popclose">닫기</button>
		</div>
		<?php }?>
    </div>
	<?php
}
?>
</div>

<!-- 레이어팝업 끝 -->


<!-- 인트로 팝업 -->
<?php if(count($introData) > 0){?>
<div class="popN popNc introLayer" style="display:<?=$_COOKIE['intropopup'] == "done" ? 'none' : 'block'?>">
	<div class="popNw">
		<div class="popNtit">
			WOOSUK <span>POPUP</span>
		</div>
		<div class="popimg">
			<div class="swiper popSwiper">
				<div class="swiper-wrapper">
				<?php for($i = 0; $i < count($introData); $i++){
				    $href = $introData[$i]['f5'] != "" ? $introData[$i]['f5'] : "#";
				    $target = $introData[$i]['f5'] != "" ? "target=\"_blank\"" : "target=\"self\"";
        	    ?>
            	<div class="swiper-slide">
            		<a href="<?=$href?>" <?=$target?>><?php echo htmlspecialchars_decode($introData[$i]['memo'])?></a>
            	</div>
            	<?php }?>	
				
				</div>
			</div>
			<div class="pop-pagination"></div>
			<div class="pop-button-next"></div>
			<div class="pop-button-prev"></div>
		</div>
		<div class="popinfo">
			<div>
				팝업 건수 총<span><?=count($introData)?>건</span>
			</div>
			<div class="not_today">하루동안 보지 않기</div>
			<div class="close">닫기</div>
		</div>
	</div>
</div>

<?php }?>
<script>
jQuery(function($) {


	$('.not_today').click(function(){
    	var todayDate = new Date();
    	todayDate.setDate( todayDate.getDate() + 1 );
    	document.cookie = "intropopup=done; path=/; expires=" + todayDate.toGMTString() + ";"
    	$('.introLayer').hide();
    });
    

	var swiper = new Swiper(".popSwiper", {
        slidesPerView: 3,    
        observer: true,
        observeParents: true,
        pagination: {
          el: ".pop-pagination",
          clickable: true,
        },
		loop:true,
		 navigation: {
        nextEl: '.pop-button-next',
        prevEl: '.pop-button-prev',
      },
      });
});
</script>
<!-- 인트로 팝업 끝-->