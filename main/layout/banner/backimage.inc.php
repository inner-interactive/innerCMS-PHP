<?php
$bannerType = 'backimage';
if (isset($bannerConfig[$bannerType]['writeColumn'])) {
    $config = isset($bannerConfig[$bannerType]['writeColumn']) ? explode("|", $bannerConfig[$bannerType]['writeColumn']) : null;
    $dbData = getBannerData($config, $bannerType);

    $imageSize = explode("*", $bannerConfig['backimage']['imageSize']);
    $height = $imageSize[1];

    if (count($dbData) > 0 && in_array('image', $config)) {
        ?>

<div class="Mainbg" style="height:<?=$height?>px">
	<?php
        for ($i = 0; $i < count($dbData); $i ++) {
            $thumbData = getFileData($dbData[$i]['banner_id'], 'backimage');
            $src = '../data/upload/' . $thumbData[0]['attach_file_name'];
            ?>	
	<div class="page">
		<div class="bg" style="background-image:url(<?=$src?>)"></div>
	</div>
	<?php }?>
</div>

<?php

}
}
?>