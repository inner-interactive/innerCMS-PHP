<?php 
if(count($menuData) > 1){
	?>
<ul class="tabs">
	<?php foreach($menuData as $value){
		$site_menuid = intval($value['site_menuid']);
		$positionArr = $MENU->getPositionArray($value['site_menuid']);
		$menu_txt = $MENU->makePositionHtml($positionArr, true);
		?>
	<li <?php if($sno == $site_menuid){?>class="active"<?php }?>><a href="<?php echo getBackUrl("menu|mode|pno|category|limit|sfv|opt")?>&sno=<?=$site_menuid?>"><?=$menu_txt?></a></li>
	<?php }?>
</ul>
<?php }?>
