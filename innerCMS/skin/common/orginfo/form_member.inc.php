<div class="popup_layer member_write_layer">
	<form action="<?php echo SKIN_URL?>member_write.php" class="member_write_form" method="post">
		<table class="table_basic">
			<caption>조직 구성원 등록</caption>
			<tbody>
				<tr>
					<th><label for="name">성명</label></th>
					<td class="tleft">
						<input type="text" id="name" name="name" class="inputs w200">
					</td>
					<th><label for="position">직위(직급)</label></th>
					<td class="tleft">
						<input type="text" id="position" name="position" class="inputs w200">
					</td>
				</tr>
				<tr>
					<th><label for="tel">사무실전화번호</label></th>
					<td class="tleft">
						<input type="text" id="tel" name="tel" class="inputs w200">
					</td>
					<th><label for="email">이메일</label></th>
					<td class="tleft" colspan="3">
						<input type="text" id="email" name="email" class="inputs w200">
					</td>
				</tr>
				<tr>
					<th><label for="work">담당업무</label></th>
					<td class="tleft" colspan="3">
						<textarea name="work" id="work" cols="30" rows="10" style="width:90%;height:80px;"></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div class="tcenter mt10">
			<input type="hidden" name="org_parent" id="member_parent" value="" />
			<input type="hidden" name="menu" value="<?php echo $menuID?>" />
			<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu|no', 1)?>" />
			<input type="submit" value="등록" class="btn btn_apply" />
			<a href="#" class="btn btn-default member_write_cancel_btn">취소</a>
		</div>
	</form>
	<div class="background"></div>
</div>