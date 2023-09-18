<?php
$bannerType = 'dday';
if (isset($bannerConfig[$bannerType]['writeColumn'])) {
    $config = isset($bannerConfig[$bannerType]['writeColumn']) ? explode("|", $bannerConfig[$bannerType]['writeColumn']) : null;
    $dbData = getBannerData($config, $bannerType);
    ?>
<div class="d-day">
	<div class="d-dayw">
		<div class="d-dayt">vision d-day</div>
		<div class="d-days">
		<?php if(count($dbData) > 0){?>
		<div id="DDay" class="d-wrapper">
		<?php
        foreach ($dbData as $value) {
            $link = in_array('link', $config) && $value['link'] != "" ? trim($value['link']) : "";
            $target = in_array('target', $config) && $value['link_target'] == "B" ? "_blank" : "_self";
            ?>
			<div class="d-list">
			<?php if($link != ""){?><a href="<?=$link?>" taget="<?=$target?>"> <?php }?>
			<?=$value['title']?>
			<?php if($link != ""){?></a><?php }?>
			</div>
		<?php }?>
		</div>
		<?php }?>
		
		</div>
	</div>

	<div class="d-daynum">
	<?php
    $c = 0;
    foreach ($dbData as $value) {
        $dday = getDday($value['start_date']);
        $ddayTxt = $dday > 0 ? "D-" . $dday : "D+" . abs($dday);
        ?>
		<div <?php if($c != 0){?> style="display: none" <?php }?>
			class="ddayc">
		<?php for($i = 0; $i < strlen($ddayTxt); $i++){?>
			<div class="dnum <?php echo $i <= 1 ? 'dcg' : 'dcr'?>"><?=substr($ddayTxt,$i,1)?></div>
		<?php }?>
		</div>
		<?php
        $c ++;
    }
    ?>
	</div>

</div>
<?php 
}?>