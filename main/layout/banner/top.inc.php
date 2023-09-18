<?php
$bannerType = 'top';
$topbannerData = array();
if (isset($bannerConfig[$bannerType]['writeColumn'])) {
    $config = isset($bannerConfig[$bannerType]['writeColumn']) ? explode("|", $bannerConfig[$bannerType]['writeColumn']) : null;
    $topbannerData = getBannerData($config, $bannerType);

    if (count($topbannerData) > 0) {
        ?>
<div class="topbanner"
	<?php if(isset($_COOKIE['topbanner']) && $_COOKIE['topbanner'] == 'done'){?>
	style="height: 0;" <?php }else{?> style="height:108px" <?php }?>>
	<div class="swiper-container topbannerw">
		<div class="swiper-wrapper">
			<?php
        for ($i = 0; $i < count($topbannerData); $i ++) {
            $thumbData = getFileData($topbannerData[$i]['banner_id'], 'top');
            $topbannerData[$i]['thumb'] = "../data/upload/" . $thumbData[0]['attach_file_name'];

            $link = in_array('link', $config) && $topbannerData[$i]['link'] != "" ? trim($topbannerData[$i]['link']) : "";
            $target = in_array('target', $config) && $topbannerData[$i]['link_target'] == "B" ? "_blank" : "_self";

            ?>
			<div class="topban swiper-slide">
				<?php if($link != ''){?>
				<a href="<?=$link?>" target="<?=$target?>">
				<?php }?>
					<img src="<?=$topbannerData[$i]['thumb']?>"
					alt="<?=$topbannerData[$i]['title']?>" />
				<?php if($link != ''){?>
				</a>
				<?php }?>
			</div>
			<?php }?>
		</div>
		<div class="swiper-pagination"></div>
		<div class="closebox">
			<div class="closecheck">
				<span>
    				<input type="checkbox" id="closet" />
    				<label for="closet">오늘 하루 열지 않음</label>
				</span> 
				<span class="closebtn"><a href="#"><img src="img/main/topbclose.png" alt="오늘 하루 열지 않음" /></a></span>
			</div>
		</div>
	</div>
</div>
<?php }?>
<?php 
}?>