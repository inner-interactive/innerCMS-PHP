<?php
$dbData = $system['html']['dbData'];

$config = $system['data']['config'];
if($userID == "")
{
	if(!isset($_POST['upw']) && !isset($_POST['name']))
	{
?>
<form action="<?=SKIN_URL?>enroll_search.php" method="post">
    <div class="write_contents">
	
		<div class="write-table">
			<div class="write-table-title">신청정보입력</div>
				<div class="write-div div50">
					<div class="write-table-th"><label for="name">성명</label></div>
					<div class="write-table-td">
						<input type="text" id="name" name="name" class="wd100" />
					</div>
				</div>
				<div class="write-div div50">
					<div class="write-table-th"><label for="upw">비밀번호</label></div>
					<div class="write-table-td">
						<input type="password" id="upw" name="upw" class="wd100" />
					</div>
				</div>
			
		</div>
		
		<div class="write-agree">
	       <div class="argee-btn">
	          <div class="argee-btn-on">
	          	<input type="submit" value="확인" style="display:inline-block;width:100%; height:100%; background:none; color:#fff; border:0" />
	          </div>
	        </div>
	      
		</div>
		<input type="hidden" name="backUrl" value="<?=getBackUrl("menu|mode", 1)?>" />
	</div>
</form>
	
<?php 	
	}
}
?>

	<div class="leftnav">
		<div class="pc mytotalviewbtn">
			<a href="<?=getBackUrl('menu')?>">교육신청하기</a>
		</div>
	</div>


	<?php if(count($dbData) != 0){?>
	<div class="list-contents">
	<!--list-->
	<div class="listboxw edulist">
		<?php for($i = 0; $i < count($dbData); $i++){
		
			$current_num = $PROGRAM->getCurrentNum($config, $dbData[$i]['indexcode']);
			$state = $PROGRAM->getProgramState($dbData[$i]['datetime1'], $dbData[$i]['datetime2'], $dbData[$i]['total'], $current_num, $prefix = '교육');
			?>
		<div class="edulistbox">
			<div class="listbox-list">
				<div class="edu_<?php echo $state['state']?>"><?php echo $state['edu']?></div>
				<div class="listbox-title"><?php echo $dbData[$i]['subject']?></div>
				<?php
				//접수기간 내이면서 신청 상태가 미승인일 경우만 취소 가능
				if($dbData[$i]['datetime1'] <= TIME_YMDHIS && $dbData[$i]['datetime2'] >= TIME_YMDHIS && $dbData[$i]['apply_status'] == 0){?>
				<div class="enroll_<?php echo $state['state']?>">
				<a href="<?php echo SKIN_URL?>apply_delete.php?no=<?php echo $dbData[$i]['no']?>&backUrl=<?php echo base64_encode(getBackUrl("menu|mode|name|upw", 1))?><?php if($upw != ""){?>&upw=<?=trim($_GET['upw'])?><?php }?>" class="btn_cancel" title="신청취소">신청취소</a>
				</div>
				<?php }?>
			</div>
			<div class="listbox-Div"> 
    			 <div class="listboximg-Div">
                    	<?php 
                		$thumbInfo = $SKIN->getFileData($menuID, $dbData[$i]['indexcode'], 'thumb');
                		if(count($thumbInfo) > 0){
                		    $src = "../data/upload/".$thumbInfo[0]['attach_file_name'];
                		}else{
                		    $src = SKIN_URL."img/non_img.png";
                		}
    				?>
                	<img src="<?=$src?>" width="<?=$SKIN->thumbnailWidth?>" height="<?=$SKIN->thumbnailHeight?>" alt="" />
                </div>            
    			<div class="listbox-txtedu">
    				<div class="listbox-name">
        					<?php 
        					$useColumn = $PROGRAM->getUseColumn($config);
        					?>
        					<ul>
                                <li class="w100">
                                	<span class="tit">접수기간</span>
                                	<span class="cont"><?php if($dbData[$i]['datetime1'] != "" && $dbData[$i]['datetime2'] != ""){?><?php echo substr($dbData[$i]['datetime1'], 0, 16)?> ~ <?php echo substr($dbData[$i]['datetime2'], 0, 16)?><?php }?></span>
        						</li>
                               
        						<li>
        							<span class="tit">진행일</span>
        							<span class="cont"><?php if($dbData[$i]['date1'] != ""){?><?php echo substr($dbData[$i]['date1'], 0, 16)?><?php }?></span>
        						</li>
        						
                                <li>
                                	<span class="tit">교육정원</span>
                                	<span class="cont"><?php echo $dbData[$i]['total']?>명 / <span class="red"><?php echo $current_num?>명</span></span>
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
			</div>
			<div class="edulist-detail"><?php echo strcut($dbData[$i]['memo'], 500)?></div>
		</div>
		<?php }?>
		
		
	</div>
	
</div>
	<?php }else{?>
	<?php 
		?>
	<div class="list-contents">
	<!--list-->
	<div class="listboxw" id="edulist">
		<div class="edulistbox">
			<div class="edulist-detail" style="border-top:1px solid #c1c1c1">교육 신청 내역이 없습니다.</div>
		</div>
	</div>
	
</div>
<?php }?>	
	
	


<script type="text/javascript">
jQuery(function($){
	$('.btn_cancel').click(function(){
		if(confirm('신청을 취소하시겠습니까?'))
			return true;
		else
			return false;
	});
});
</script>