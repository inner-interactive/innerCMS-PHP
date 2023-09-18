<?php 
	if(!$SKIN->commentUse) return;
	$cdb = $system['data']['commentdata'];
?>
<div class="commentallwrapper">

	<div class="commentView">
		<ul>
		<?php for($i = 0; $i < count($cdb); $i++){ if(intval($cdb[$i]['delflag']) == 1){$del_in="<del>"; $del_out="</del>";}else{$del_in = $del_out = "";}?>
			<li>
				<dl class="cominf">
					<dt>
						<span<?php if($cdb[$i]['commentrank'] > 0){ echo " class=\"rank".$cdb[$i]['commentrank']."\""; }?>><?php  if($cdb[$i]['commentrank'] > 0){?><img src="img/skin/re.gif" alt="답변글" /><?php }?><?=$cdb[$i]['uname']?></span>
						<span><?=$cdb[$i]['writetime']?></span>
					</dt>
					<?php if($grantValue['auth_comment']){?>
					<dd>
						<span class="cbutton">
							<?php if(intval($cdb[$i]['replyrank']) < 1){	// 1단계 댓글만 허용하도록 함?>
							<a href="#" class="reply" title="코멘트 답글">답글</a>
							<?php }?>
	
							<?php if($userID == $cdb[$i]['uid'] || $grantValue['auth_admin']){?>
							<a href="#" class="edit" title="코멘트 수정">수정</a>
								
							<?php }?>
						</span>
					</dd>
					<?php }?>
				</dl>
	
				<div class="commentTextArea">
					<div class="commentText"><?=$del_in.$cdb[$i]['memo'].$del_out?></div>
				</div>
	
				<div class="commentwriteinner">
					<form action="comment.php" method="post" enctype="multipart/form-data">
						<fieldset>
							<legend>코멘트 입력 폼</legend>
					
							<?php if($userID  != ""){	// 로그인 사용자 일 경우에?>
							<input type="hidden" name="uid" value="<?=$userID?>" />
							<input type="hidden" name="uname" value="<?=$userName?>" />
							<?php }else{	// 비로그인 사용자 일 경우에?>
								<p class="writerinformation">
									<label for="unameinner<?=$i?>">이름</label><input type="text" name="uname" id="unameinner<?=$i?>" value="<?=$userName?>" />
									<label for="upwinner<?=$i?>">비밀번호</label><input type="password" name="upw" id="upwinner<?=$i?>" value="" style="ime-mode:disabled;" />
								</p>
							<?php }?>
					
							<?php if($userID == "") {
							?>
							<p class="captcha_layer">
							
							</p>
							<?php } ?>
							
							<?php if($userID == $cdb[$i]['uid'] || $grantValue['auth_admin']){?>
							<?php if(!$cdb[$i]['delflag']){?>
								<span class="button medium"><a href="#" class="delHide" title="코멘트 삭제">삭제</a></span>
								<?php }?>
							<?php }?>
							
							<?php if($grantValue['auth_admin']){?>
							<span><a href="#" class="delReal" title="코멘트 완전삭제">완전삭제</a></span>
								<?php if($cdb[$i]['delflag']){?>
							<span><a href="#" class="recover" title="코멘트 복구">복구</a></span>
								<?php }?>
							<?php }?>
					
							<div class="commentBox">
								<label for="commentinner<?=$i?>" class="labelhidden">코멘트 내용</label>
								<textarea id="commentinner<?=$i?>" class="memo" name="memo" required data-text="<?=$cdb[$i]['memo']?>"></textarea>
								<div class="commententer">
									<span class="button medium"><a href="#" class="close" title="취소">취소</a></span>
									<span class="button medium"><a href="#" class="apply" title="코멘트 답글 등록하기">확인</a></span>
								</div>
							</div>
							<input type="hidden" name="no" value="<?=$no?>" />
							<input type="hidden" name="cno" value="<?=$cdb[$i]['indexcode']?>" />
							<input type="hidden" name="opt" class="opt" value="0" />
							<input type="hidden" name="action" class="action" value="" />
							<input type="hidden" name="menu" value="<?=$menuID?>" />
							<input type="hidden" name="backUrl" value="<?=getBackUrl("menu|pno|category|limit|no|mode|".$_GET['sfv']."|sfv|opt")?>" />
						</fieldset>
					</form>
					
					
				</div>
	
			</li>
		<?php }?>
	
		<?php if($i == 0){?>
			<li class="nocmt">등록된 코멘트가 없습니다.</li>
		<?php }?>
		</ul>
	</div>




	<!-- 코멘트 등록 -->
	<?php if($grantValue['auth_comment']){?>
	<div class="commentwrite">
		<form action="comment.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>코멘트 입력 폼</legend>
				<?php if($userID != ""){	// 로그인 사용자 일 경우에?>
				<input type="hidden" name="uid" value="<?=$userID?>" />
				<input type="hidden" name="uname" value="<?=$userName?>" />
				<?php }else{	// 비로그인 사용자 일 경우에?>
				
				<p class="writerinformation">
					<label for="uname">이름</label><input type="text" name="uname" id="uname" value="" required />
					<label for="upw">비밀번호</label><input type="password" name="upw" id="upw" value="" required />
				</p>
				
				<p class="regnum">
					<?php 
					$captcha_html = captcha_html();
					echo $captcha_html;
					?>
					</p>
				<?php }?>
	
				<div class="commentBox">
					<label for="memo" class="labelhidden">코멘트 내용</label><br />
					<textarea id="memo" name="memo" required></textarea>
					<div class="commententer">
						<span><input type="image" alt="코멘트 달기" src="img/skin/enter.gif" /></span>
						<input type="hidden" name="backUrl" value="<?=getBackUrl("menu|upw|pno|category|limit|no|".$_GET['sfv']."|sfv|opt")?>&amp;mode=view" />
						<input type="hidden" name="no" value="<?=$no?>" />
						<input type="hidden" name="menu" value="<?=$menuID?>" />
						<input type="hidden" name="action" value="write" />
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<?php }?>
</div>

<script>
	var captcha_use = '<?=$userID == '' ? "Y" : "N"?>';
</script>