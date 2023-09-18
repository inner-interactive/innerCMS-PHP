
<div class="calendar-box">
	<div class="calendar-category">
		<?php  if($SKIN->categoryUse){?>
		<?php foreach($SKIN->categoryList as $key => $value){?>
		<span class="i-con i-con<?=$key+1?>"><em><?=mb_substr($value, 0, 3)?></em><?=$value?></span>
		<?php }?>
		<?php }?>
	</div>
	<div class="month">
		<ul>
			<li><a href="<?=getBackUrl("menu")?>&amp;date=<?=$pre_date?>"
				class="date_btn prev"><img src="<?=SKIN_URL?>img/cal-prev.png"
					alt="이전달 버튼" /></a></li>
			<li><a href="<?=getBackUrl("menu")?>&amp;date=<?=$next_date?>"
				class="date_btn next"><img src="<?=SKIN_URL?>img/cal-next.png"
					alt="다음달 버튼" /></a></li>
			<li class="now"><?=$year?>년 <?=$month?>월</li>
		</ul>
	</div>
	<ul class="weekdays">
		<?php foreach($WEEKDAY as $value){?>
		<li><?=$value?></li>
		<?php }?>
	</ul>
	<ul class="days">
	<?php
$day_counter = strtotime($start_date);
for ($j = 0; $j < $total_week; $j ++) {
    ?>
				<?php
    for ($i = 0; $i < 7; $i ++) {
        $index = date("Y-m-d", $day_counter);
        $_class = $day_info[$index]["class"];
        $_w = date("w", $day_counter);
        $isToday = false;
        if ($day_info[$index]["isToday"] == "yes")
            $isToday = true;
        ?>
			<li class="<?=$_class?><?=$i % 7 == 0 ? " bono" : "";?>">
			<div class="daynum"><?=substr($index,8,2)?><span class="mweekday">(<?=$WEEKDAY[$_w]?>)</span>
			</div>
					<?php
        if ($day_info[$index]["class"] != "gray") {
            for ($k = 0; $k < count($day_info[$index]['data']); $k ++) {
                $_data = unserialize($day_info[$index]['data'][$k]);
                foreach ($SKIN->categoryList as $key => $value) {
                    if ($value == $_data['category'])
                        $_cate_num = $key + 1;
                }
                $_del_in = isset($_data['delflag']) && intval($_data['delflag']) == 1 ? "<del>" : "";
                $_del_out = isset($_data['delflag']) && intval($_data['delflag']) == 1 ? "</del>" : "";
                $_subject = $_del_in . trim($_data['subject']) . $_del_out;
                $_memo = trim($_data['memo']);
                $_thumb = $_data['thumb'];
                if (count($_thumb) > 0) {
                    $src = "../data/" . SITE_NAME . "_" . $menuID . "/thumb/" . $_thumb[0]['attach_file_name'];
                } else
                    $src = "";

                ?>
					<div class="con">
				<a href="#" class="event"> <span class="i-con i-con<?=$_cate_num?>"><em><?=mb_substr($_data['category'], 0, 3)?></em></span>
								<?=$_subject?>
							</a>
				<div class="carlender-pop<?=$src != "" ? " pop_l" : " pop_s"?>">
							<?php if($src != ""){?>
							<div class="car-pimg">
						<img src="<?=$src?>" style="width:<?=$SKIN->thumbnailWidth?>px; height:<?=$SKIN->thumbnailHeight?>px" />
					</div>
							<?php }?>
							<div class="car-plist">
						<div class="car-plist-title"><?=$_subject?><a href="#"
								class="pop_close">x</a>
						</div>
						<div class="car-plist-memo"><?=$_memo?></div>
						<div class="car-plist-icon">
							<div class="cate"><?=$_data['category']?></div>
									
									<?php if($_data['f3'] != ""){?>
									 <div class="viewbtn">
								<a href="<?=$_data['f3']?>">상세보기</a>
							</div>
									<?php }?>
								</div>
					</div>
					<div></div>
				</div>
			</div>
							
					<?php
            }
        }
        ?>
			</li>
				<?php
        $day_counter += 60 * 60 * 24;
    }
    ?>
			<?php }?>
	</ul>
</div>




<div class="btnbox">
	<?php if($grantValue['auth_write']){?>
	<a class="btn btn-default"
		href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write"
		title="일정등록">일정등록</a> <a class="btn btn-default"
		href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=list"
		title="달력보기">목록보기</a>
	<?php }?>
</div>

