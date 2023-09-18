<?php 
$dbData = $system['data']['dbData'];
$config = $system['data']['config'];
$introduce = htmlspecialchars_decode($config['memo']);
?>



<?php 
if($introduce != ""){
?>
<div class="eduskin-top">
<!-- 	<div class="eduskin-tops">소개</div> -->
	<div class="eduskin-topt"><?php echo htmlspecialchars_decode($introduce); ?></div>
</div>
<?php }?>


<?php include "leftnav.inc"; ?>
<div class="list-contents">

	<?php if($reservUseCheck){?>	
	<div class="edu-time">
		<img src="<?=SKIN_URL?>img/eduplus.png" alt="" />사전 접수는 서버 시각을 기준으로 합니다.<span> 현재 서버 시각 : <b id="svtime"><?php echo date("Y-m-d H:i:s")?></b> </span>
	</div>
	<?php }?>
	
	<div class="edulist">
	
		<?php 
		for($i = 0; $i < count($dbData); $i++){
			$total_num = intval($dbData[$i]['total']);
			$current_num = $PROGRAM->getCurrentNum($config, $dbData[$i]['indexcode']);
			$state = $PROGRAM->getProgramState($dbData[$i]['datetime1'], $dbData[$i]['datetime2'], $dbData[$i]['total'], $current_num);
			$viewLink = getBackUrl("menu|category|limit|sfv|opt")."&mode=view&no=".$dbData[$i]['indexcode'];
			$applyLink = getBackUrl("menu|category|limit|sfv|opt")."&mode=write&no=".$dbData[$i]['indexcode'];
		?>
		<div class="edulistbox">
			<div class="listbox-list">
			
				<?php if($reservUseCheck){?>
				<div class="edu_<?php echo $state['state']?>"><?php echo $state['edu']?></div>
				<?php }?>
				<div class="listbox-title"><a href="<?=$viewLink?>" title="<?php echo $dbData[$i]['subject']?> 교육 상세페이지로 이동"><?php echo $dbData[$i]['subject']?></a></div>
				<?php if($reservUseCheck){?>
				<div class="enroll_<?php echo $state['state']?>">
					<a href="<?=$applyLink?>" title="<?php echo $dbData[$i]['subject']?> 교육 상세페이지로 이동"><?php echo $state['enroll']?></a>
				</div>
				<?php }else{?>
				<div class="enroll_after">
					<a href="<?=$viewLink?>" title="<?php echo $dbData[$i]['subject']?> 교육 상세페이지로 이동">내용보기</a>
				</div>
				<?php }?>
			</div>
			<div class="listbox-Div">            
                <div class="listboximg-Div">
                	<a href="<?=$viewLink?>" title="<?php echo $dbData[$i]['subject']?> 교육 상세페이지로 이동">
                	<?php 
                		$thumbInfo = $SKIN->getFileData($menuID, $dbData[$i]['indexcode'], 'thumb');
                		if(count($thumbInfo) > 0){
                		    $src = "../data/upload/".$thumbInfo[0]['attach_file_name'];
                		}else{
                		    $src = SKIN_URL."img/non_img.png";
                		}
    				?>
                	<img src="<?=$src?>" width="<?=$SKIN->thumbnailWidth?>" height="<?=$SKIN->thumbnailHeight?>" alt="" />
    	            </a>
                </div>            
                <div class="listboxw-Div">
                    <div class="listbox-txtedu">
        				<div class="listbox-name">
        					<?php 
        					$useColumn = $PROGRAM->getUseColumn($config);
        					?>
        					<ul>
        						<?php if($SKIN->categoryUse){?>
								<li class="w100">
									<span class="tit">카테고리</span>
									<span class="cont"><?=$dbData[$i]['category']?></span>
								</li>
								<?php }?>
								
        						<?php if($reservUseCheck){?>
                                <li>
                                	<span class="tit">접수기간</span>
                                	<span class="cont"><?php if($dbData[$i]['datetime1'] != "" && $dbData[$i]['datetime2'] != ""){?><?php echo substr($dbData[$i]['datetime1'], 0, 16)?> ~ <?php echo substr($dbData[$i]['datetime2'], 0, 16)?><?php }?></span>
        						</li>
        						<li>
                                	<span class="tit">교육정원</span>
                                	<span class="cont"><?php echo $total_num?>명 / <span class="red"><?php echo $current_num?>명</span></span>
                                </li>
        						<?php }?>
                               
        						<li class="">
        							<span class="tit">교육기간</span>
        							<span class="cont"><?=$PROGRAM->getProgressDateText($dbData[$i])?></span>
        						</li>
        						
							
        						
                                 
                                <?php foreach($useColumn as $key => $value){?>
                                <li>
                                	<span class="tit"><?=$value?></span>
	        						<span class="cont"><?=$dbData[$i][$key]?></span>
                                </li>
        						<?php }?>
        					</ul>
        				</div>
        			</div>
        			<div class="edulist-detail"><a href="<?=$viewLink?>" title="<?php echo $dbData[$i]['subject']?> 교육 상세페이지로 이동"><?php echo strcut($dbData[$i]['memo'], 500)?></a></div>
                </div>
            </div>
		</div>
		<?php }?>
		
		
	</div>
	
</div>


<?php include BASE_SKIN_PATH."pagination.inc.php"?>


