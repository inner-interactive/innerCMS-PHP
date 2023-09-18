<div class="popup_layer team_write_layer">
	<form action="<?php echo SKIN_URL?>team_write.php" class="team_write_form" method="post">
		<table class="table_basic">
			<caption>팀(부서)등록</caption>
			<tbody>
				<tr>
					<th><label for="org_name">팀(부서)명</label></th>
					<td class="tleft">
						<input type="text" id="org_name" name="org_name" class="inputs w200">
					</td>
				</tr>
			</tbody>
			
		</table>
		
		<div class="tcenter mt10">
			<input type="hidden" id="org_parent" name="org_parent" value="" />
			<input type="hidden" name="menu" value="<?php echo $menuID?>" />
			<input type="hidden" name="backUrl" value="<?php echo getBackUrl('menu', 1)?>" />
			<input type="submit" value="등록" class="btn btn_apply" />
			<a href="#" class="btn btn-default team_write_cancel_btn">취소</a>
		</div>
	</form>
	<div class="background"></div>
</div>
