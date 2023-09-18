<?php
$dbData = $system['data']['dbData'];
$fileData = $system['data']['fileData'];
?>
<div class="page_write">
	<fieldset>
		<legend>글 입력 폼</legend>
		<div class="box">
			<strong class="title"><label for="subject">제목</label></strong> <span
				class="input"><input type="text" name="subject" id="subject"
				class="w100p" value="<?=$dbData[0]['subject']?>" /></span>
		</div>

		<?php if($SKIN->categoryUse){?>
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

		<div class="box">
			<strong class="title"><label for="date1">기간</label></strong> <span
				class="input"> <input type="text" name="date1" id="date1"
				class="date_input datepicker" value="<?=$dbData[0]['date1']?>" /> ~
				<input type="text" name="date2" id="date2"
				class="date_input datepicker" value="<?=$dbData[0]['date2']?>" />
			</span>
		</div>

		<div class="box">
			<strong class="title">반복요일설정</strong> <span class="input">
				<?php
    $repeat_day_list = $dbData[0]['f1'] != "" ? explode("|", $dbData[0]['f1']) : array();
    foreach ($WEEKDAY as $key => $value) {
        ?>
				<input type="checkbox" name="f1[]" id="week<?=$key?>"
				value="<?=$key?>"
				<?=in_array($key, $repeat_day_list) ? "checked=\"checked\"" : "";?> />
				<label for="week<?=$key?>"><?=$value?></label>
				<?php }?>
				<p class="describe">반복요일에 체크하지 않으면 기간내 모든 요일에 반복표시됩니다.</p>
			</span>
		</div>

		<div class="box">
			<strong class="title"><label for="f2">제외날짜입력</label></strong> <span
				class="input">
				<?php
    $except_day_list = $dbData[0]['f2'] != "" ? explode("|", $dbData[0]['f2']) : array();
    for ($i = 0; $i < 20; $i ++) {
        $_except_day = isset($except_day_list[$i]) ? $except_day_list[$i] : "";
        ?>
				<input type="text" name="f2[]" class="date_input datepicker"
				style="margin: 0 5px 5px 0" value="<?=$_except_day?>" />
				<?php }?>
				<p class="describe">제외 날짜를 입력하면 기간 내 제외날짜에는 표시되지 않습니다.</p>
			</span>
		</div>

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

			<?php echo $captcha_html?>

		</div>
		<?php }?>

		<div class="box">
			<strong class="title"><label for="memo">내용</label></strong> <span
				class="input"><textarea name="memo" id="memo" cols="30"
					style="width: 75%" placeholder="일정내용은 간락하게 적어주세요"><?=$dbData[0]['memo']?></textarea></span>
		</div>

		<div class="box">
			<strong class="title"><label for="f3">url</label></strong> <span
				class="input"> <input type="text" name="f3" id="f3" class="w100p"
				value="<?=$dbData[0]['f3']?>"
				placeholder="일정에 관련된 url 주소가 있으면 입력해 주세요." />
			</span>
		</div>

		<!-- 첨부파일 시작 -->
		<?php if($grantValue['auth_filedown']){?>
		<?php
    if (count($fileData) > 0) {
        ?>
		<div class="file">
			<div>
				<span>첨부파일</span>
			</div>
			<div class="allfile">
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
				</div>
		</div>
		<?php
    }
}
?>
		<!-- 첨부파일 끝 -->

		<div class="thume">
			<?php  if($grantValue['auth_fileup']){?>
			<div class="insert">
				<ul>
					<li><input class="upload-name" disabled="disabled" /> <label
						for="pfile">섬네일파일</label><input class="upload-hidden" type="file"
						name="pfile" id="pfile" /></li>
					<!-- 
					<li><input class="upload-name" disabled="disabled" /> <label for="sfile1">첨부파일1</label><input class="upload-hidden" type="file" name="sfile[]" id="sfile1" /></li>
					<li><input class="upload-name" disabled="disabled" /> <label for="sfile2">첨부파일2</label><input class="upload-hidden" type="file" name="sfile[]" id="sfile2" /></li>
					<li><input class="upload-name" disabled="disabled" /> <label for="sfile3">첨부파일3</label><input class="upload-hidden" type="file" name="sfile[]" id="sfile3" /></li>
					<li><input class="upload-name" disabled="disabled" /> <label for="sfile4">첨부파일4</label><input class="upload-hidden" type="file" name="sfile[]" id="sfile4" /></li>
					 -->
				</ul>
			</div>
			<p class="guide">* 최대 첨부파일 용량은 <?=$SKIN->limitFileSizeTxt?> 입니다. 제한 용량을 초과하는 파일은 제외됩니다.</p>
			<?php }?>
		</div>
		<div id="hiddenMemoPic"></div>
	</fieldset>
</div>
