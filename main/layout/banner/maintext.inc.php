<?php
$bannerType = 'maintext';
$config = isset($bannerConfig[$bannerType]['writeColumn']) ? explode("|", $bannerConfig[$bannerType]['writeColumn']) : null;
if (isset($bannerConfig[$bannerType]['writeColumn'])) {
    $dbData = getBannerData($config, $bannerType);

    $titleCutByte = isset($bannerConfig[$bannerType]['titleCutByte']) ? intval($bannerConfig[$bannerType]['titleCutByte']) : 100;
    $memoCutByte = isset($bannerConfig[$bannerType]['memoCutByte']) ? intval($bannerConfig[$bannerType]['memoCutByte']) : 100;

    if (count($dbData) > 0) {
        ?>
<div class="maintext">
	<div id="maintext" class="maintextsecw">
	<?php
        for ($i = 0; $i < count($dbData); $i ++) {
            $link = in_array('link', $config) && $dbData[$i]['link'] != "" ? trim($dbData[$i]['link']) : "";
            $target = in_array('target', $config) && $dbData[$i]['link_target'] == "B" ? "_blank" : "_self";
            ?>
		<div class="maintextsec">
		
			<?php if(in_array('subtitle', $config) && $dbData[$i]['subtitle'] != ''){?>
			<div class="textsubtitle"><?=$dbData[$i]['subtitle']?></div>
			<?php }?>
			
			<?php if(in_array('title', $config)){?>
			<div class="texttitle">
				<p>
				<?php if($link != ''){?><a href="<?=$link?>" target="<?=$target?>"><?php }?>
				<?=nl2br(strcut($dbData[$i]['title'], $titleCutByte))?>
				<?php if($link != ''){?></a><?php }?>
				</p>
			</div>
			<?php }?>
			
			<?php if(in_array('memo', $config)){?>
			<div class="textmemo">
				<p>
				<?php if($link != ''){?><a href="<?=$link?>" target="<?=$target?>"><?php }?>
				<?=nl2br(strcut($dbData[$i]['memo'],$memoCutByte));?>
				<?php if($link != ''){?></a><?php }?>
				</p>
			</div>
			<?php }?>
			
			<?php if($link != ""){?>
            <div class="textmore">
				<a href="<?=$link?>" target="<?=$target?>">자세히보기</a>
			</div>
            <?php }?>
		</div>
	<?php
        }
        ?>
	</div>

	<div class="prev"></div>
	<div class="next"></div>
</div>
<?php }
}?>