<?php
$dbData = $system['data']['dbData'];
$fileData = $system['data']['fileData'];
$thumbData = $system['data']['thumbData'];
?>
<div class="page_write">
	<fieldset>
		<legend>글 입력 폼</legend>
		<div class="box">
			<strong class="title"><label for="subject">제목</label></strong> <span
				class="input"><input type="text" name="subject" id="subject"
				class="w100p" value="<?=$dbData[0]['subject']?>" /></span>
		</div>

		<?php  if($SKIN->categoryUse){?>
		<div class="box">
			<strong class="title"><label for="category">카테고리</label></strong> <span
				class="input"> <select id="category" name="category">
					<?php  for($i = 0; $i < count($SKIN->categoryList); $i++){?>
						<option value="<?=$SKIN->categoryList[$i]?>"
						<?=isselected($SKIN->categoryList[$i], $dbData[0]['category'])?>><?=$SKIN->categoryList[$i]?></option>
					<?php }?>
				</select>
			</span>
		</div>
		<?php }?>

		<?php if($grantValue['auth_secret']){?>
		<div class="box half_box">
			<strong class="title"><label for="issecret">비밀글</label></strong> <span
				class="input"><input type="checkbox" name="issecret" id="issecret"
				value="1" <?=ischecked($dbData[0]['issecret'], '1')?> /></span>
		</div>
		<?php }?>

		<?php

if ($userName == "") {
    $captcha_html = captcha_html();
    // 비 로그인 사용자 일 경우에 ?>
		<div class="nomember">

			<p>
				<?php if($mode == "write" || $mode == "reply"){?>
				<label for="uname">이름</label><input type="text" name="uname"
					id="uname" value="" /> <label for="upw">비밀번호</label><input
					type="password" name="upw" id="upw" value=""
					style="ime-mode: disabled;" />
				<?php }else if($mode == "update"){?>
				<label>이름</label><input type="text" name="uname" id="uname"
					value="<?=$dbData[0]['uname']?>" readonly />
				<?php }?>
			</p>
			<p></p>

			<?php echo $captcha_html?>

		</div>
		<?php }?>

		<div class="writememo">
			<?php echo editor_html("memo", $dbData[0]['memo']);?>
		</div>

		<!-- 첨부파일 시작 -->
		<?php if($grantValue['auth_filedown']){?>
		<?php
    if (count($thumbData) > 0) {
        ?>
		<div class="file">
			<ul>
				<li><span>섬네일파일</span></li>
				<li class="allfile">
				<?php
        $fileicon = getFileIcon($thumbData[0]['file_ext']);
        ?>
				<span class="item"> <img
						src="../common/img/file/<?=$fileicon['icon']?>"
						alt="<?=$fileicon['ext']?> 파일 이미지" /> <a
						href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$thumbData[0]['file_id']?>"
						title="<?=$thumbData[0]['down_file_name']?> 파일 다운로드"><?=$thumbData[0]['down_file_name']?></a>
						<span> <a
							href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$thumbData[0]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|sfv"))?>"
							class="del_file"
							title="<?=$thumbData[0]['down_file_name']?> 파일 삭제">삭제</a>
					</span>
				</span>
					<?php
        ?>
				</li>
			</ul>
		</div>
		<?php
    }
    ?>
		<?php
    if (count($fileData) > 0) {
        ?>
		<div class="file">
			<ul>
				<li><span>첨부파일</span></li>
				<li class="allfile">
				<?php
        for ($i = 0; $i < count($fileData); $i ++) {
            $fileicon = getFileIcon($fileData[$i]['file_ext']);
            ?>
				<span class="item"> <img
						src="../common/img/file/<?=$fileicon['icon']?>"
						alt="<?=$fileicon['ext']?> 파일 이미지" /> <a
						href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$fileData[$i]['file_id']?>"
						title="<?=$fileData[$i]['down_file_name']?> 파일 다운로드"><?=$fileData[$i]['down_file_name']?></a>
						<span> <a
							href="filedelete.php?menu=<?=$menuID?>&amp;no=<?=$fileData[$i]['file_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|mode|no|pno|category|limit|sfv"))?>"
							class="del_file"
							title="<?=$fileData[$i]['down_file_name']?> 파일 삭제">삭제</a>
					</span>
				</span>
					<?php
        }
        ?>
				</li>
			</ul>
		</div>
		<?php
    }
}
?>
		
		<?php include BASE_SKIN_PATH."pfile_upload.inc.php"?>
		
	</fieldset>
</div>
<script type="text/javascript">
$('.editor_form').submit(function(){
	<?php 
		echo get_editor_js('memo');
		echo chk_editor_js('memo');
	?>
});
</script>