<?php
$dbData = $system['data']['dbData'];
$config = $system['data']['config'];
$picData = $system['data']['picData'];
$files1Data = $system['data']['files1Data'];
$files2Data = $system['data']['files2Data'];
$total_num = intval($dbData[0]['total']);
$current_num = $PROGRAM->getCurrentNum($config, $dbData[0]['indexcode']);
$state = $PROGRAM->getProgramState($dbData[0]['datetime1'], $dbData[0]['datetime2'], $dbData[0]['total'], $current_num);

?>
<div class="eduview-leftnav">
	<div id="edu_slide" class="eduview-Bimg">
		<?php for($i = 0; $i < count($picData); $i++){?>
		<a href="../data/upload/<?php echo $picData[$i]['attach_file_name']?>"><img src="../data/upload/<?php echo $picData[$i]['attach_file_name']?>" alt="" /></a>
		<?php }?>
		<?php if(count($picData) == 0){?>
		<img src="<?=SKIN_URL?>img/non_img.png" alt="noimage" />
		<?php }?>
	</div>
</div>

<div class="view-contents">
	<div class="viewbox">
		<div class="eudview-list">
			<?php if($reservUseCheck){?>
			<div class="edu_<?php echo $state['state']?>"><?php echo $state['edu']?></div>
			<?php }?>
			<div class="listbox-title"><?php echo $dbData[0]['subject']?></div>
		</div>
		<div class="listbox-txtedu">
		
			<div class="listbox-name">
				<ul>
				
					<?php if($SKIN->categoryUse){?>
					<li class="w100">
						<span class="tit">카테고리</span>
						<span class="cont"><?=$dbData[0]['category']?></span>
					</li>
					<?php }?>
					
					<?php if($reservUseCheck){?>
					<li>
						<span class="tit">접수기간</span>
						<span class="cont"><?php if($dbData[0]['datetime1'] != "" && $dbData[0]['datetime2'] != ""){?><?php echo substr($dbData[0]['datetime1'], 0, 16)?> ~ <?php echo substr($dbData[0]['datetime2'], 0, 16)?><?php }?></span>
					</li>
					<li>
						<span class="tit">모집정원</span>
						<span class="cont"><?php echo $total_num?>명 / <span class="redpen"><?php echo $current_num?>명</span></span>
					</li>
					<?php }?>
					
					<li>
						<span class="tit">진행기간</span>
						<span class="cont"><?=$PROGRAM->getProgressDateText($dbData[0])?></span>
					</li>
				
					
				
			
			<?php 
                $useColumn = $PROGRAM->getUseColumn($config);
                foreach($useColumn as $key => $value){
				?>
					<li>
						<span class="tit"><?=$value?></span>
						<span class="cont"><?=$dbData[0][$key]?></span>
					</li>
			<?php }?>
				</ul>
			</div>
			
			
			
			<?php 
			if(count($files1Data) > 0)
			{
			?>
			<div class="listbox-name">
				<ul class="w100">
					<li><span>첨부파일</span></li>
					<li>
						<?php 
							for($i = 0; $i < count($files1Data); $i++){
							$fileicon = getFileIcon($files1Data[$i]['file_ext']);
							?>
						<img src="../common/img/file/<?php echo $fileicon['icon']?>" width="14" height="12" alt="icon" />
						<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$files1Data[$i]['file_id']?>" title="<?=$files1Data[$i]['down_file_name']?> 파일 다운로드"><?=$files1Data[$i]['down_file_name']?></a>
						<?}
						?>
					</li>
				</ul>
			</div>
			
			<?php }?>
			
		</div>
		<div class="eduviewbtn">
			<?php 
				 if($state['state'] == "ing")
				 {
				 	$st_link = getBackUrl("menu|no|category|limit|sfv|opt")."&mode=write";
				 }else if($state['state'] == "before")
				 {
				 	$st_link = "javascript:alert('해당 프로그램은 접수예정입니다.');";
				 }else if($state['state'] == "after")
				 {
				 	$st_link = "javascript:alert('해당 프로그램은 접수마감 되었습니다.');";
				 }
				 
				 if($PROGRAM->reservUseCheck($config)){
			?>
			<a href="<?php echo $st_link?>" class="enroll_<?php echo $state['state']?>" style="float:none"><?php echo $state['enroll']?></a>
			<?php }?>
		</div>
		<div class="eduview-detail">
			<div class="eduview-sns">
				<a href="#" class="send_twitter"><img src="../common/img/sns/sns_twitter.gif" alt="트위터" /></a>
				<a href="#" class="send_facebook"><img src="../common/img/sns/sns_facebook.gif" alt="페이스북" /></a>
				<a href="#" class="send_google"><img src="../common/img/sns/sns_google.gif" alt="구글" /></a>
			</div>
			<div class="eduview-detail-v">
				<div class="eduview-detail-t">목표</div>
				<div class="eduview-detail-s">
					<?php echo htmlspecialchars_decode($dbData[0]['etc'])?>
				</div>
			</div>
			<div class="eduview-detail-v">
				<div class="eduview-detail-t">내용</div>
				<div class="eduview-detail-s">
					<?php echo htmlspecialchars_decode($dbData[0]['memo'])?>
				</div>
			</div>
			<div class="v-line"></div>
		</div>
		<div class="edulistbtn">
			<a href="<?=getBackUrl("menu|category|limit|sfv|opt")?>">목록</a>
		</div>
	</div>
</div>



