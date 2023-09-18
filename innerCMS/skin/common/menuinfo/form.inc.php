<?php
$dbData = $system['data']['dbData'];

$default_menu_type = "contents";

if($mode == "write"){
	$menu_type = isset($_GET['type']) && $_GET['type'] != "" ? trim($_GET['type']) : $default_menu_type;
}else if($mode == "update"){
	
	if(isset($_GET['type']) && $_GET['type'] != ""){
		$menu_type = trim($_GET['type']);
	}else{
		$menu_type = isset($dbData['menu_type']) && $dbData['menu_type'] != "" ? trim($dbData['menu_type']) : $default_menu_type;
	}

}
?>

<table class="table_basic">
	<caption>메뉴 정보 입력 </caption>
	<colgroup>
		<col width="20%"/>
		<col width="30%"/>
		<col width="20%"/>
		<col width="30%"/>
	</colgroup>
	<tbody>
		<tr>
			<th class="highlight1"><label for="menu_title">메뉴명*</label></th>
			<td class="tleft" colspan="3"><input type="text" id="menu_title" name="menu_title" value="<?php echo $dbData['menu_title']?>" class="inputs w300" /></td>
		</tr>
		<tr>
			<th class="highlight1"><label for="menu_type">메뉴 타입</label></th>
			<td class="tleft">
				<select name="menu_type" id="menu_type" class="inputs">
				<option value="">선택</option>
				<?php foreach($menuTypeList as $key => $value){?>
				<option value="<?=$key?>" <?=isselected($key, $dbData['menu_type'])?>><?=$value?></option>
				<?php }?>
				</select>
			</td>
			<th>메뉴 숨기기</th>
			<td class="tleft">
				<input type="checkbox" id="menu_hide1" name="menu_hide1" value="1" <?php echo ischecked(1, $dbData['menu_hide1'])?> /><label for="menu_hide1">대메뉴</label>
				<input type="checkbox" id="menu_hide2" name="menu_hide2" value="1" <?php echo ischecked(1, $dbData['menu_hide2'])?> /><label for="menu_hide2">사이드메뉴</label>
				<input type="checkbox" id="menu_hide3" name="menu_hide3" value="1" <?php echo ischecked(1, $dbData['menu_hide3'])?> /><label for="menu_hide3">사이트맵</label>
			</td>
			
		</tr>
		
		<tr>
			<th><label for="parent_id">상위메뉴선택</label></th>
				<td class="tleft">
				<?php if($mode == "write"){?>
				<select name="parent_id" id="parent_id">
					<option value="0">없음</option>
					<?php $menuInfo->getMenuOption(0, 1, $siteKey, $dbData['menu_id'], $dbData['parent_id']);?>
				</select>
				<?php }else if($mode == "update"){ 
				    echo $dbData['parent_id'] > 0 ? $menuInfo->getMenuHierarchy($dbData['menu_id']) : "없음";
				}?>
			</td>
			<th><label for="second_id">하위메뉴선택</label></th>
			<td class="tleft">
				<select name="second_id" id="second_id">
					<option value="0">없음</option>
					<?php $menuInfo->getSecondMenuOption(0, 1, $siteKey, $dbData['second_id']);?>
				</select>
			</td>
		</tr>
		
		<tr>
			<th><label for="bodyfile">페이지 바디 선택*</label></th>
			<td class="tleft">
				<select name="bodyfile" id="bodyfile">
				<?php 
				foreach($bodyFileList as $value) {
				?>
					<option value="<?php echo $value?>" <?php echo isselected($value, $dbData['bodyfile'])?>><?php echo $value?></option>
				<?php 
				}
				?>
				</select>
			</td>
			<th>메뉴 새창</th>
			<td class="tleft">
				<label for="self">현재창</label><input type="radio" id="self" name="target" value="S" <?php echo ischecked("S", $dbData['target'])?> class="inputs" />
				<label for="blank">새창</label><input type="radio" id="blank" name="target" value="B" <?php echo ischecked("B", $dbData['target'])?> class="inputs" />
			</td>
		</tr>

		
	</tbody>
</table>
	
<table class="table_basic mt20 menu_type contents">
	<caption>페이지</caption>
	<colgroup>
		<col width="10%"/>
		<col width="*"/>
	</colgroup>
	<tbody>
    	<tr>
    		<th>입력방식</th>
    		<td class="tleft">
    			
    			<input type="radio" name="use_file" id="use_file_N" data-no="<?=$dbData['menu_id']?>" value="0" <?=$mode == 'write' ? "checked" : ""?> <?=ischecked(0, $dbData['use_file'])?> />
    			<label for="use_file_N">에디터 입력</label>
    			<input type="radio" name="use_file" id="use_file_Y" data-no="<?=$dbData['menu_id']?>" value="1" <?=ischecked(1, $dbData['use_file'])?> />
    			<label for="use_file_Y">소스코드 입력</label>
    		</td>
    	</tr>
    	<?php if(count($system['data']['contentsHistoryData']) > 0){?>
    	<tr>
    		<th>컨텐츠 수정내역</th>
    		<td class="tleft">
    			<div class="history_layer">
    			<?php foreach($system['data']['contentsHistoryData'] as $history){?>
    			<a href="#" data-no="<?=$history['content_id']?>" class="in_btn btn-default<?=$history['isapply'] ? " btn_apply" : ""?> mb5 setContents"><?=$history['writetime']?></a>
    			<?php }?>
    			</div>
    		</td>
    	</tr>
    	<?php }?>
		<tr>
			<td colspan="2">
				<textarea name="contents" id="contents" cols="30" rows="10" style="width:100%;height:500px"><?=$contents?></textarea>
			</td>
		</tr>
	</tbody>
</table>

<table class="table_basic mt20 menu_type link">
	<caption>링크</caption>
	<tbody>
		<tr>
			<th><label for="href">메뉴 링크 주소</label></th>
			<td colspan="3" class="tleft"><input type="text" id="href" name="href" value="<?php echo $dbData['href']?>" class="inputs wd90" /></td>
		</tr>
	</tbody>
</table>

<script type="text/javascript">


$('.text_select').click(function(){
	no = $(this).data('indexcode');
	$.ajax({
		url : '<?=SKIN_URL?>testAjax.php',
		type : 'get',
		dataType : 'html',
		data : { no : no},
		success : function(html){
			//console.log(html);
			$('#contents').text(html);
			oEditors.getById['contents'].exec("LOAD_CONTENTS_FIELD")
		}
	});
	return false;
});

</script>


<table id="skin_table" class="table_basic mt20 menu_type skin">
	<caption>게시판</caption>
	<colgroup>
		<col width="20%"/>
		<col width="30%"/>
		<col width="20%"/>
		<col width="30%"/>
	</colgroup>
	<tbody>
		
		<tr>
			<th><label for="skinUrl">게시판 스킨</label></th>
			<td colspan="3" class="tleft">
					<?php 
					
						$skinData = $menuInfo->getSkinData($siteKey);
						foreach($skinData as $key => $value){
						?>
							<div class="skinGroup">
								<h3><?=$key?></h3>
								<?php 
								if(count($value) > 0){
								?>
								<ul>
								<?php 
									foreach($value as $value2){
										$screenShotPath = BASE_PATH."/".$siteKey."/skin/".$key."/".$value2."/screenshot.jpg";
										
										
									?>
									<li class="skinThumb">
										<input type="radio" id="<?=$key."/".$value2?>" name="skinUrl" <?=ischecked($dbData['skin_group']."/".$dbData['skin'], $key."/".$value2)?> value="<?=$key."/".$value2?>" />
										<label for="<?=$key."/".$value2?>"><?=$value2?></label>
										<?php 
										if(file_exists($screenShotPath)){
											$screenShotUrl = BASE_URL."/".$siteKey."/skin/".$key."/".$value2."/screenshot.jpg";
										?>
										<div class="screenshot">
											<img src="<?=$screenShotUrl?>" alt="" />
										</div>
										<?php 
										}
										?>
									</li>
									<?php 
									}
								?>
								</ul>
								<?php 
								}
								?>
							</div>
						<?php 
						}
					?>
			</td>
		</tr>
		<tr>
			<th><label for="db_table">DB Table 선택</label></th>
			<td class="tleft">
				<select name="db_table" id="db_table">
				<option value="">선택</option>
				<?php foreach($DBTableList as $value){?>
				<option value="<?php echo $value?>" <?php echo isselected($value, $dbData['db_table'])?>><?php echo $value?></option>
				<?php }?>
				</select>
				<select name="db_table2" id="db_table2" style="display:none">
				<option value="">선택</option>
				<?php foreach($DBTableList as $value){?>
				<option value="<?php echo $value?>" <?php echo isselected($value, $dbData['db_table2'])?>><?php echo $value?></option>
				<?php }?>
				</select>
			</td>
			<th><label for="table_make">DB Table명 입력(테이블 자동생성)</label></th>
			<td colspan="3" class="tleft">
				<input type="text" id="table_make" name="table_make" value="" class="inputs w100" />
			</td>
		</tr>
		
		<tr>
			<th><label for="list_limit_num">글목록제한수 (기본 <?=$menuInfo->default_list_limit_num?>개)</label></th>
			<td class="tleft">
				<input type="text" id="list_limit_num" name="list_limit_num" value="<?php echo $dbData['list_limit_num']?>" class="inputs w100" />
			</td>
			<th><label for="subject_limit_num">제목글자제한</label></th>
			<td class="tleft">
				<input type="text" id="subject_limit_num" name="subject_limit_num" value="<?php echo $dbData['subject_limit_num']?>" class="inputs w100" />
			</td>
		</tr>
		<tr>
			<th><label for="html_use">HTML 사용여부</label></th>
			<td class="tleft">
				<?php 
					$selectHmode = 0;
					if($mode == "write"){
						$selectHmode = 2;	//글쓰기 모드에서는 기본적으로 모두허용이 선택되어 있게 설정
					}else if($mode == "update"){
						if($dbData['menu_type'] == $menu_type){	
							$selectHmode = $dbData['html_use'];	//설정된 메뉴 타입과 선택된 메뉴 타입이 같을 때 ( 모두 skin 일때)
						}else{
							$selectHmode = 2;	//설정된 메뉴 타입과 선택된 메뉴 타입이 다를 때(inc 메뉴를 skin으로 변경할 때 기본 선택된 html 사용여부가  허용안함으로 저장 되어 있기 때문에 모두허용으로 변경 )
						}
					}
				?>
				<select class="w150" id="html_use" name="html_use">
					<option value="0" <?php echo isselected(0, $selectHmode)?>>허용안함</option>
					<option value="1" <?php echo isselected(1, $selectHmode)?>>부분허용</option>
					<option value="2" <?php echo isselected(2, $selectHmode)?>>모두허용</option>
				</select>
			</td>
			<th><label for="upload_ext">업로드 가능 확장자(구분 : ,)</label></th>
			<td class="tleft">
				<input type="text" id="upload_ext" name="upload_ext" value="<?php echo $dbData['upload_ext']?>" class="inputs w300" />
			</td>
		</tr>
		<tr>
			<th><label for="upload_size">업로드 최대크기</label></th>
			<td class="tleft">
				<input class="inputs w100" type="text" id="upload_size" name="upload_size" value="<?php echo $dbData['upload_size']?>">
				<select name="upload_unit" value="MB">
					<option value="MB" <?php echo isselected("MB", $dbData['upload_unit'])?>>MB</option>
					<option value="GB" <?php echo isselected("GB", $dbData['upload_unit'])?>>GB</option>
					<option value="TB" <?php echo isselected("TB", $dbData['upload_unit'])?>>TB</option>
				</select>
			</td>
			<th><label for="thumb_size">썸네일 사이즈(예: 150 * 150)</label></th>
			<td class="tleft">
				<input class="inputs w100" type="text" id="thumb_size" name="thumb_size" value="<?php echo $dbData['thumb_size']?>">
			</td>
		</tr>
		<tr>
			<th><label for="category_use">카테고리사용</label></th>
			<td colspan="3" class="tleft">
				<input type="checkbox" id="category_use" name="category_use" value="1" <?php echo ischecked(1, $dbData['category_use'])?> />
			</td>
		</tr>
		<tr id="cateListRow">
			<th><label for="category_list">카테고리리스트 콤마(,)로 구분</label></th>
			<td colspan="3" class="tleft"><textarea name="category_list" id="category_list" class="inputs wd90" style="height:50px"><?php echo $dbData['category_list']?></textarea></td>
		</tr>
		
		<tr>
			<th><label for="comment_use">코멘트사용</label></th>
			<td colspan="3" class="tleft">
				<input type="checkbox" id="comment_use" name="comment_use" value="1" <?php echo ischecked(1, $dbData['comment_use'])?> />
			</td>
		</tr>
		
		<tr>
			<th><label for="skin_header">상단디자인</label></th>
			<td colspan="3" class="tleft">
				<?php echo editor_html('skin_header', $dbData['skin_header'])?>
			</td>
		</tr>
		<tr>
			<th><label for="skin_tail">하단디자인</label></th>
			<td colspan="3" class="tleft">
				<?php echo editor_html('skin_tail', $dbData['skin_tail'])?>
			</td>
		</tr>
		<tr>
			<th>권한</th>
			<td colspan="3" style="overflow:hidden">
    			<table id="grant_table" class="table_basic ml20 mr20 mt20 menu_type skin">
                
                	<tbody>
                		<tr>
                    	<?php 
                    	$i = 0;
                    	foreach($menuInfo->grantList as $grant){
                    	    
                    		$grantTitle = $grant['title'];
                    		$grantName =  $grant['name'];
                    		
                    		$selected = "";
                    		if($mode == "write"){	//write모드에서는 목록,내용, 다운로드 권한을 디폴트 값 비로그인 사용자로 세팅
                    			if($grantName == "auth_list" || $grantName == "auth_view" || $grantName == "auth_filedown"){
                    				$selected = 0; 
                    			}
                    		}else{
                    			$selected = $dbData[$grant['name']];
                    		}
                    	?>
                    		<th><label for="<?=$grantName?>"><?=$grantTitle?></label></th>
                    		<td class="tleft type_group">
                    			<select name="<?=$grantName?>" id="<?=$grantName?>">
                    			<?php $menuInfo->getGroupOption($selected)?>
                    			</select>
                    			<br />
                    		</td>
                    	<?php if($i % 2 == 1){?>
                    	</tr>
                    	<tr>
                    	<?php }?>
                    	<?php 
                    	   $i++;
                    	}?>
                		</tr>
                	</tbody>
                </table>
			</td>
		</tr>
	</tbody>
</table>
	



<script type="text/javascript">
$('.editor_form').submit(function(){

	<?php 
		echo get_editor_js('skin_header');
		echo get_editor_js('skin_tail');
		echo get_editor_js('contents');
		?>
});
</script>
