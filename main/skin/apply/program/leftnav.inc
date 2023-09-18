<div class="leftnav">
	<?php if($reservUseCheck){?>
	<div class="pc mytotalviewbtn">
		<?php if($mode == "status"){?>
		<a href=" <?=getBackUrl('menu')?>">교육신청하기</a>
		<?php }else{?>
		<a href="<?=getBackUrl('menu')?>&mode=status">나의 신청현황</a>
		<?php }?>
	</div>
	<?php }?>
	
	<?php if($SKIN->categoryUse){?>
	<div class="leftbox">
		<div class="leftnav-title m01">교육분야</div>
		<div class="edustay">
			<div class="group-check">
				<span class="tmp-check">
					<input type="checkbox" class="ca_search" name="cate" id="term" value="<?=getBackUrl("menu|mode|start_date|end_date|status|limit|sfv|opt")?>" <?php echo ischecked("", $category)?> />
					<label for="term" title="전체"><span></span>전체</label>
				</span>
				<?php 
				foreach($SKIN->categoryList as $key => $value){
					$value = trim($value);
				?>
				<span class="tmp-check">
					<input type="checkbox" class="ca_search" name="cate-p1" id="cate_p<?php echo $key+1?>" value="<?=getBackUrl("menu|mode|start_date|end_date|status|limit|sfv|opt")?>&category=<?php echo $value?>" <?php echo ischecked($value, $category)?> />
					<label for="cate_p<?php echo $key+1?>" title="<?php echo $value?>"><span></span><?php echo $value?></label>
				</span>
				<?php }?>
			</div>
		</div>
	</div>
	<?php }?>
	
	<?php if($reservUseCheck){?>
	<div class="leftbox">
		<div class="leftnav-title m01">교육상태</div>
		<div class="edustay">
			<div class="group-check">
				<?php 
				$edu_status_arr = array("전체", "진행교육", "예정교육", "지난교육");
				foreach($edu_status_arr as $key => $value){
				?>
				<span class="tmp-check">
					<input type="checkbox" class="st_search" name="term-p1" id="term_p<?php echo $key+1?>" value="<?=getBackUrl("menu|mode|start_date|end_date|category|limit|sfv|opt")?>&status=<?php echo $key?>" <?php echo ischecked($key, $status)?> />
					<label for="term_p<?php echo $key+1?>" title="<?php echo $value?>"><span></span><?php echo $value?></label>
				</span>	
				<?php }?>
			</div>
		</div>
	</div>
	
	<div class="leftbox">
		<form action="<?php echo SKIN_URL?>datesearch.php" method="post">
			<div class="leftnav-title m01">접수기간</div>
			<div class="eduday">
				<div>
					<span class="d1">시작일 </span>
					<span class="d2"><input type="text" id="start_date" name="start_date" value="<?php echo $start_date?>" readonly class="datepicker" /></span>
					<span class="d3"><img id="st_search" src="<?=SKIN_URL?>img/totalbtn.png" alt="" /></span>
				</div>
				<div>
					<span class="d1">종료일 </span>
					<span class="d2"><input type="text" id="end_date" name="end_date" value="<?php echo $end_date?>" readonly class="datepicker" /></span>
					<span class="d3"><img id="ed_search" src="<?=SKIN_URL?>img/totalbtn.png" alt="" /></span>
				</div>
			</div>
			<input type="hidden" name="backUrl" value="<?php echo base64_encode(getBackUrl("menu|mode|category|limit|sfv|opt|status", 1))?>" />
		</form>
	</div>
	<?php }?>
	
	<?php if(false){?>
	<div class="leftbox">
		<div class="leftnav-title m01">문의내용</div>
		<div class="moremenu">
			<div class="morebox">
				<div class="morebox-s">
					<p><?=$introduce?></p>
					<p></p>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>
