<?php
$dbData = $system['data']['dbData'][0];
$picData = $system['data']['picData'];
$files1Data = $system['data']['files1Data'];
$files2Data = $system['data']['files2Data'];
?>
<div class="btn-box">
	<a href="<?=getBackUrl("menu|category|limit|sfv|opt")?>">목록</a>
</div>

<section class="viewinfo">

	<div class="view-img">
    	<?php  if(count($picData) > 0){?>
		<div class="swiper-wrapper">
        <?php 
            for($i = 0; $i < count($picData); $i++){?>  
       		<div class="swiper-slide"><a href="#"><img src="../data/upload/<?php echo $picData[$i]['attach_file_name']?>"></a></div>
       		<?php 
            } ?>
        </div>
        <?php }else{?>
		<div><a href="#"><img src="<?=SKIN_URL?>img/view_img.png"></a></div>
       	<?php }?>
       	
        <?php if(count($picData) > 1){?>
        	<a href="#" class="imgprev"><img src="<?=SKIN_URL?>img/sub_gallery_prev.png"></a>
        	<a href="#" class="imgnext"><img src="<?=SKIN_URL?>img/sub_gallery_next.png"></a>
    	<?php }?>
	</div>
	
	<div class="view-detail">
		<div class="view-title"><?=$dbData["subject"]?></div>
		<div class="view-subtitle"><?=$dbData["category"]?></div>
		<div class="view-line"></div>
		<div class="view-list">
			<ul>
				<li><span class="bold">주 소 : </span><span><?=$dbData["address"]?> <?=$dbData["address2"]?></span></li>
				<li><span class="bold">위 치 : </span><span><?=$dbData["location"]?></span></li>
				<li><span class="bold">면 적 : </span><span><?=$dbData["size"]?></span></li>
				<li><span class="bold">접 수 방 법 : </span><span><?=$dbData["apply_way"]?></span></li>
			</ul>
		</div>
		<div class="view-num">
			<div class="view-numbox">
				<div class="view-num1">
					<span>수용인원</span>
				</div>
				<div class="view-num2"><?php echo $dbData["max_person"]?></div>
			</div>
  
  			<?php if($dbData["admin_phone"]){?>
 			 <div class="view-numbox">
				<div class="view-num1 phone">
					<span>문의 연락처</span>
				</div>
				<div class="view-num4"><?php echo $dbData["admin_phone"]?></div>
			</div>
			<?php }?>
  
		</div>
		<div class="view-txt">
			<?php if($dbData['reservation_use']){?>
			<a href="<?=getBackUrl("menu|category|limit|sfv|no")?>&amp;mode=calendar"><img src="<?=SKIN_URL?>img/sub_sinbtn.png" alt="예약하기" />&nbsp;예약하기</a>
			<?php }?>
		</div>
	</div>
</section>

<section class="viewtabinfo">
	<ul class="tabs">
		<li class="active">시설현황</li>
		<li>이용요금</li>
		<li>사용자준수사항</li>
		<li>찾아오시는길</li>
	</ul>
	<div class="tab_container">
		<div class="tab_content"><?php echo htmlspecialchars_decode($dbData["memo1"])?></div>
		<div class="tab_content"><?php echo htmlspecialchars_decode($dbData["memo2"])?></div>
		<div class="tab_content"><?php echo htmlspecialchars_decode($dbData["memo3"])?></div>
		<div class="tab_content"><?php include SKIN_URL."map.php"; ?></div>
	</div>
</section>
 
<div class="btn-box">
	<a href="<?=getBackUrl("menu|category|limit|sfv|opt")?>">목록</a>
</div>




