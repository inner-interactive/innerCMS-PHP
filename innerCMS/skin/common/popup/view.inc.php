<?php
$dbData = $system['data']['dbData'];
?>
<table class="table_basic">
	<caption>팝업 정보 보기</caption>
	<colgroup>
		<col width="10%"/>
		<col width="40%"/>
		<col width="10%"/>
		<col width="40%"/>
	</colgroup>
	<tbody>
		<tr>
			<th>팝업 제목</th>
			<td colspan="3" class="tleft"><?php echo $dbData['subject']?></td>
		</tr>
		<tr>
			<th>사이트</th>
			<td class="tleft">
				<?=$system['siteList'][$dbData['site']]['author']?>
			</td>
			<th>팝업기간</th>
			<td class="tleft">
				<?php echo $dbData['start_date']?> ~  <?php echo $dbData['end_date']?>
			</td>
		</tr>
		
		<tr>
			<th>창사이즈</th>
			<td class="tleft">
				가로<?php echo $dbData['width']?>px * 세로<?php echo $dbData['height']?>px
			</td>
			<th>창위치</th>
			<td class="tleft">
				좌측<?php echo $dbData['left']?>px
				상단<?php echo $dbData['top']?>px
			</td>
		</tr>
		<tr>
			<th>팝업방식</th>
			<td class="tleft">
				<?php 
				if($dbData['pop_type'] == 'popup'){
				    echo '팝업창';
				}else if($dbData['pop_type'] == 'layer'){
				    echo '레이어';
				}else if($dbData['pop_type'] == 'intro'){
				    echo '인트로';
				}
				?>
			</td>
			<th>팝업 옵션</th>
			<td class="tleft">
				<input type="checkbox" id="not_today" name="not_today" value="1" <?=ischecked(1, $dbData['not_today'])?> disabled class="inputs" />
				오늘은 이창을 다시 열지 않음
				<input type="checkbox" id="isstop" name="isstop" value="1" <?=ischecked(1, $dbData['isstop'])?> disabled class="inputs" />
				팝업중지
				<input type="checkbox" id="subject_display" name="subject_display" value="1" <?=ischecked(1, $dbData['subject_display'])?> disabled class="inputs" />
				제목표시
			</td>
		</tr>
		
		<tr>
			<th>팝업내용</th>
			<td colspan="3" class="tleft">
			<?php echo htmlspecialchars_decode($dbData['memo']);?>
			</td>
		</tr>
		
	</tbody>
</table>

<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=write" title="팝업등록">팝업등록</a>
	<a class="btn btn_modify" href="<?=getBackUrl("menu|no|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>&amp;mode=update">수정</a>
	<a class="btn btn_delete pop_delete" href="<?=SKIN_URL?>delete.php?no=<?=$dbData['pop_id']?>&amp;backUrl=<?=urlencode(getBackUrl("menu|pno|category|limit|opt", 1))?>">삭제</a>
	<a class="btn btn-default" href="<?=getBackUrl("menu|pno|category|limit|sfv|".$_GET['sfv']."|opt")?>">목록</a>
</div>