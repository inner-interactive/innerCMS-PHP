<?php 
$dbData = $system['data']['dbData'];
$config = $system['data']['config'];
$picData = $system['data']['picData'];
$files1Data = $system['data']['files1Data'];
$files2Data = $system['data']['files2Data'];
?>
<form action="<?=SKIN_URL?>write.php" class="editor_form" method="post" enctype="multipart/form-data">
	<div class="write_contents">
		<div class="write-table">
			<div class="write-table-title">
				<span class="pname"><?=$dbData[0]['subject']?></span> 접수신청서
			</div>
			<div class="write-div div50">
				<div class="write-table-th">
					<label for="name">신청자 성명*</label>
				</div>
				<div class="write-table-td">
					<input type="text" id="name" name="name" class="wd100" />
				</div>
			</div>
			<div class="write-div div50">
				<div class="write-table-th">
					<label for="mo1">핸드폰*</label>
				</div>
				<div class="write-table-td">
					<select id="mo1" name="mo1" class="wd30">
						<option value="010">010</option>
						<option value="011">011</option>
					</select> - 
					<input type="text" name="mo2" class="wd30" maxlength="4" /> - 
					<input type="text" name="mo3" class="wd30" maxlength="4" />
				</div>
			</div>
			<div class="write-div">
				<div class="write-table-th">
					<label for="e_id">이메일</label>
				</div>
				<div class="write-table-td">
					<input type="text" id="e_id" name="e_id" class="wd30" />@ <input type="text" id="e_domain" name="e_domain" class="wd30" />
					<select class="w240" id="domain">
						<option value="">직접입력</option>
						<option value="naver.com">naver.com</option>
						<option value="daum.net">daum.net</option>
						<option value="nate.com">nate.com</option>
						<option value="gmail.com">gmail.com</option>
					</select>
				</div>
			</div>
				<?php 
                $useColumn = $PROGRAM->getUseColumn($config, 'apply');
                $i = 0;
                foreach($useColumn as $key => $value){
                    if($i == count($useColumn) - 1 && count($useColumn) % 2 == 1){    //사용 컬럼이 홀수개일 경우 마지막 컬럼에는 div50 클래스를 넣지 않는다.
                        $_div_class = "";
                    }else{
                        $_div_class = " div50";
                    }
                ?>
			
				<div class="write-div<?=$_div_class?>">
					<div class="write-table-th">
						<label for="<?=$key?>"><?=$value?></label>
					</div>
					<div class="write-table-td">
						<div class="group-check">
							<input type="text" id="<?=$key?>" name="<?=$key?>" class="wd100" />
						</div>
					</div>
				</div>
			
				<?php 
				    $i++;
                }?>
				
				
			<?php if(isset($config['finish_check_type']) && $config['finish_check_type'] == 1){?>
				<div class="write-div">
					<div class="write-table-th">
						<label for="num1">
						참여인원(신청자포함)*
						</label>
					</div>
					<div class="write-table-td">
						<input type="text" id="num1" name="num1" class="" style="width: 140px;" placeholder="숫자만 입력"  />명 <br />
					</div>
				</div>
			<?php }?>
		
			<?php if($userID == ""){?>
    		<div class="write-div write-address">
    			<div class="write-table-th" style="height: 70px;">
    				<label for="upw">비밀번호*</label>
    			</div>
    			<div class="write-table-td" style="height: 70px; line-height: 70px;">
    				<input type="password" id="upw" name="upw" class="w370" />
    				<p>- 비밀번호는 나의 신청현황 확인시 사용됩니다.</p>
    			</div>
    		</div>
			<?php }?>
		
		 
		<?php if(count($files2Data) > 0){?>
			<div class="write-div">
				<div class="write-table-th">신청파일</div>
				<div class="write-table-td">
				<?php
				for ($i = 0; $i < count($files2Data); $i++) {
					$fileicon = getFileIcon($files2Data[$i]['file_ext']);
					?>
						<p style="color: red; height: 15px; line-height: 15px; padding: 10px 0 5px 0">* 아래 파일을 다운받아 작성해서 업로드 해주세요</p>
						<p style="height: 15px; line-height: 15px; padding: 10px 0">
							<img src="../common/img/file/<?php echo $fileicon['icon']?>" width="14" height="12" alt="icon" />
							<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$files2Data[$i]['file_id']?>" title="<?=$files2Data[$i]['down_file_name']?> 파일 다운로드"><?=$files2Data[$i]['down_file_name']?></a>
						</p>
					<?
				
				}
				?>
				</div>
			</div>
			<div class="write-div">
				<div class="write-table-th">파일첨부</div>
				<div class="write-table-td">
					<span> <label for="sfile1">첨부파일1</label> <input type="file" name="sfile[]" id="sfile1" />
					</span> <span> <label for="sfile2">첨부파일2</label> <input type="file" name="sfile[]" id="sfile2" />
					</span> <span> <label for="sfile3">첨부파일3</label> <input type="file" name="sfile[]" id="sfile3" />
					</span>
				</div>
			</div>
		<?php }?>
		
		
		</div>
		<div class="write-agree">
    		<div class="write-agree-stitle">개인정보 수집 항목 및 이용동의</div>
    		<div class="agreein">
    			<ul>
    				<li>가. 이용 목적</li>
    				<ul>
    					<li>- 서비스(회원가입, ID/PW찾기 등)이용을 위한 본인인증</li>
    					<li>- 본인인증을 위한 휴대폰 소유자 확인 결과</li>
    					<li>- 휴대폰 소지 확인을 위한 SMS 인증번호 전송</li>
    					<li>- 부정 이용 방지 및 수사의뢰</li>
    					<li>- 기타 법률에서 정한 목적</li>
    				</ul>
    				<li>나. 수집 및 제공하는 정보</li>
    				<ul>
    					<li>- 성명, 성별, 생년월일, 내/외국인, 휴대폰번호, 이동통신사 [제공사 : 서비스 회원사]</li>
    					<li>- 성명, 성별, 생년월일, 휴대폰번호, 이동통신사 [제공사 : SKT, KT, LGU+,드림시큐리티,모빌리언스, 다날, KCT]</li>
    					<li>- 휴대폰번호 [제공사 : SKT, KT, LGU+, 삼성SDS, 드림시큐리티, 모빌리언스, SK네트웍스, 케이스카이비, 다날, KCT]</li>
    					<li>- IP주소 [제공사 : 서비스 회원사]</li>
    				</ul>
    			</ul>
    		</div>
    		<div style="text-align: center">
    			<input type="checkbox" name="agree" value="1" id="a2" /><label for="a2">동의(필수)</label>
    		</div>
    		<div class="argee-btn">
    			<div class="argee-btn-gray">
    				<a href="<?php echo getBackUrl("menu|no")?>&mode=view">이전</a>
    			</div>
    			<div class="argee-btn-on">
    				<input type="submit" title="확인" value="신청하기" />
    			</div>
    		</div>
    	</div>
	</div>
	
	<div class="btnbox">
		<input type="hidden" name="backUrl" value="<?=getBackUrl("menu|pno|category|limit|no|sfv|opt", 1)?>" />
		<input type="hidden" name="no" value="<?=$no?>" />
		<input type="hidden" name="menu" value="<?=$menuID?>" />
	</div>
</form>
