<?php 
$configData = $system['data']['config'];
$dbData = $system['data']['dbData'];
$thumbData = $system['data']['thumbData'];
$picData = $system['data']['picData'];
$files1Data = $system['data']['files1Data'];
$files2Data = $system['data']['files2Data'];

?>
<?php if($reservUseCheck){?>
<ul class="tabs">
	<li <?php if($view == "edu"){?>class="active"<?php }?>><a href="<?php echo getBackUrl("menu|mode|no|sno|pno|category|limit|sfv|opt")?>&view=edu">교육정보보기</a></li>
	<li <?php if($view == "enroll"){?>class="active"<?php }?>><a href="<?php echo getBackUrl("menu|mode|no|sno|pno|category|limit|sfv|opt")?>&view=enroll">신청자정보보기</a></li>
</ul>
<?php }?>

<?php include "view_".$view.".inc";?>

<div class="function mt30">
	<a href="<?php echo getBackUrl("menu|sno|pno|category|limit|sfv|opt")?>&amp;mode=list" class="btn btn-default">목록</a>
	<a href="<?php echo getBackUrl("menu|no|sno|pno|category|limit|sfv|opt")?>&amp;mode=update" class="btn btn_modify">수정</a>
	<a href="<?=SKIN_URL?>delete.php?menu=<?=$menuID?>&no=<?=$_GET['no']?>&backUrl=<?=base64_encode(getBackUrl("menu|sno", 1))?>" class="btn btn_delete program_delete">삭제</a>
</div>
