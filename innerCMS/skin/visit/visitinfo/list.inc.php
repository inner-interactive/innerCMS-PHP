<div class="function mt30">
	<ul class="tabs">
	<?php foreach($system['siteList'] as $key => $value){
	    if($key == "innerCMS") continue;
    ?>
	<li<?php if($siteKey == $key){?> class="active"<?php }?>><a href="<?=getBackUrl("menu|view")?>&amp;site=<?=$key?>&amp;fr_date=<?=$fr_date?>&amp;to_date=<?=$to_date?>"><?=$value['author']?></a></li>
	<?php }?>
	</ul>
</div>



<div class="mb30">
	<form action="<?=SKIN_URL?>search.php" method="post">
		<fieldset>
				<table class="table_basic">
					<caption>기간 검색</caption>
				<tbody>
				
					<tr>
						<th scope="col"><label for="fr_date">기간 검색</label></th>
						<td class="tleft">
							<input type="text" id="fr_date" name="fr_date" value="<?=$fr_date?>" class="inputs" /> ~
							<input type="text" id="to_date" name="to_date" value="<?=$to_date?>" class="inputs" />
							<input type="hidden" name="site" value="<?=$siteKey?>" />
							<input type="hidden" name="type" value="<?=$type?>" />
							<input type="submit" value="검색" class="in_btn btn_apply" />
							
							<div class="mt10">
							<?php foreach($searchDayList as $value){
								$_class = $fr_date == $value['fr_date'] && $to_date == $value['to_date'] ? " btn_apply" : "";
							?>
							<a href="<?=SKIN_URL?>search.php?site=<?=$siteKey?>&fr_date=<?=$value['fr_date']?>&to_date=<?=$value['to_date']?>&type=<?=$type?>" class="in_btn btn-default<?=$_class?>"><?=$value['title']?></a>
							<?php }?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>
</div>



<div class="searchterm"><?=$searchTermText?></div>

<div class="mb30">
<table class="table_basic">
		<caption>방문자통계</caption>
		
		<thead>
		<tr>
			<th>총방문자수</th>
		</tr>
		</thead>
	<tbody>
	
		<tr>
			<td><?=$sum_count?>명</td>
		</tr>
	</tbody>
</table>
</div>

<?php if($type != "visitor"){?>
<ul class="viewtab">
	<li class="active"><a href="#">차트로 보기</a></li>
	<li><a href="#">테이블로 보기</a></li>
</ul>
<?php }?>

<div class="conts mt10">
<?php
$dbData = $system['data']['dbData'];
$file = dirname(__FILE__)."/type_".$type.".inc.php";
if(file_exists($file)) include $file;
?>
</div>
