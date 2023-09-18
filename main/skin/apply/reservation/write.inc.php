<?php 
$dbData = $system['data']['dbData'];
echo POSTCODE_JS;
?>
<form action="<?=SKIN_URL?>write.php" name="reservation_form" method="post" enctype="multipart/form-data">

    <div class="writebox">
        <div class="de-titlebox">
        	<div class="de-day"><?=$reservationTimeText?></div>
        	<div class="de-titledetail">
        		<span class="de-title"><?=$dbData[0]['subject']?></span> <span class="de-subtitle">사용신청서</span>
        	</div>
        </div>
    
    	
        
        <div class="de-form">
        	<div class="de-form-title">담당자(신청자)</div>
        	<div class="de-form-table">
        		<div class="de-form-tr tr50">
        			<div class="de-form-th"><label for="uname">성명 *</label></div>
        			<div class="de-form-td">
        				<span><input type="text" placeholder="이름" class="w180 mw130" id="uname" name="uname" required /></span>
        			</div>
        		</div>
        				<div class="de-form-tr tr50">
        			<div class="de-form-th"><label for="upw">비밀번호 *</label></div>
        			<div class="de-form-td">
        				<input type="password" class="w280" id="upw" name="upw" placeholder="예약내역확인을 위한 비밀번호 입력" required />
        			</div>
        		</div>
        		
        		<div class="de-form-tr tr50">
        			<div class="de-form-th"><label for="mobile1">휴대폰 *</label></div>
        			<div class="de-form-td">
        				<select class="w70" id="mobile1" name="mobile1" required />
        					<?php foreach($system['data']['mobile'] as $value){?>
							<option value="<?=$value?>"><?=$value?></option>
							<?php }?>
						</select>
						<span class="pr5 pl5"> -</span> 
						<input type="tel" class="w70" name="mobile2" required /> 
						<span class="pr5 pl5"> -</span> 
						<input type="tel" class="w70" name="mobile3" required/>
        			</div>
        		</div>
        
        		<div class="de-form-tr tr50">
        			<div class="de-form-th"><label for="phone1">전화</label></div>
        			<div class="de-form-td">
        				<select class="w70" id="phone1" name="phone1">
        				<?php foreach($system['data']['phone'] as $value){?>
						<option value="<?=$value?>"><?=$value?></option>
						<?php }?>
						</select> 
						<span class="pr5 pl5"> -</span> 
						<input type="tel" class="w70" name="phone2" /> 
						<span class="pr5 pl5"> -</span> 
						<input type="tel" class="w70" name="phone3" />
        			</div>
        		</div>
        
        		<div class="de-form-tr">
        			<div class="de-form-th"><label for="email">이메일 </label></div>
        			<div class="de-form-td">
        				<input type="email" class="w630" id="email" name="email"  />
					</div>
        		</div>
        	</div>
        </div>
        
        
        <div class="de-form">
        	<div class="de-form-title">
        		사용신청
        	</div>
        	<div class="de-form-table">
        		<div class="de-form-tr">
        			<div class="de-form-th"><label for="use_purpose">사용목적 *</label></div>
        			<div class="de-form-td">
        				<input type="text" id="use_purpose" name="use_purpose" required />
        			</div>
        		</div>
        		<div class="de-form-tr">
        			<div class="de-form-th"><label for="use_people">사용인원 *</label></div>
        			<div class="de-form-td">
        				<input type="number" id="use_people" name="use_people" class="w160 mw130" placeholder="숫자만 입력"> 명
        			</div>
        		</div>
        		
        		
        	</div>
        </div>
        
        <div class="de-form">
        	<div class="de-form-title">
        		신청단체<div>개인 자격으로 신청하실 경우에는 이 영역은 작성을 안하셔도 됩니다.</div>
        	</div>
        	<div class="de-form-table">
        		<div class="de-form-tr">
        			<div class="de-form-th"><label for="group_name">단체명</label></div>
        			<div class="de-form-td">
        				<input type="text" id="group_name" name="group_name" />
        			</div>
        		</div>
        		<div class="de-form-tr tr50">
        			<div class="de-form-th"><label for="ceo_name">대표자 성명</label></div>
        			<div class="de-form-td">
        				<input type="text" id="ceo_name" name="ceo_name" />
        			</div>
        		</div>
        		<div class="de-form-tr tr50">
        			<div class="de-form-th"><label for="biz_num">사업자등록번호</label></div>
        			<div class="de-form-td">
        				<input type="text" id="biz_num" name="biz_num" />
        			</div>
        		</div>
        		<div class="de-form-tr address-tr">
        			<div class="de-form-th"><label for="zipcode">주소</label></div>
        			<div class="de-form-td">
        				<p><input type="text" class="w200 mw130" id="zipcode" name="zipcode"><a href="#" id="zipsearch" class="de-btn">우편번호검색</a></p>
        				<p><input type="text" class="w630" id="address" name="address"></p>
        				<p><input type="text" class="w630" id="address2" name="address2"></p>
        			</div>
        		</div>
        		<div class="de-form-tr">
        			<div class="de-form-th">신청경로</div>
        			<div class="de-form-td">
        				<div class="group-check">
        					<?php 
        					   $routes = array('홈페이지', '언론보도', 'SNS', '지인소개', '재방문', '기타');
        					   foreach($routes as $key => $value){
        					?>
        					<span class="tmp-check"> 
            					<input type="checkbox" name="apply_route[]" id="apply_route<?=$key?>" value="<?=$value?>"> 
            					<label for="apply_route<?=$key?>" title="<?=$value?>"><span></span><?=$value?></label>
        					</span>
        					<?php }?> 
        					</span>
        				</div>
        
        			</div>
        		</div>
        	</div>
        </div>
        
        
        
        <div class="counter-total">
        	<div class="counter-total-txt">
        		<b class="title_txt_price">
            		<span><?=$dbData[0]['subject']?> 대관료 (<?=$timeCountTxt?>)</span> <span class="won"> <?=number_format($reservationFee)?>원</span>
            	</b>
        	</div>
        	<div class="counter-total-count">
        		<div class="counter-list">
        			총 예약금액 <span class="won"><?=number_format($reservationFee)?>원</span>
        		</div>
        		<div class="counter-txt">(예약금액은 부가세 포함금액입니다.)</div>
        	</div>
        
        </div>
        
        
        <div class="de-form">
        	<div class="de-form-title"><label for="etc">전달(문의)사항</label></div>
        	<div class="mun">
        		<textarea name="etc" id="etc"></textarea>
        	</div>
        </div>
        
        <div class="de-form">
        	<div class="de-form-title">개인정보 동의</div>
        	<div class="agreein-title">개인정보 수집·활용 및 참여단체 사진 촬영·활용 동의</div>
        	<div class="agreein">
				<ul>
					<li>* 개인정보보호법 제15조, 제 22조 및 제24조 규정에 따라 <?=$system['site']['author']?>에서 아래와 같이 개인정보를 수집, 이용함에 동의합니다.
            			<ul>
            				<li>※ 개인정보 취급방침</li>
            				<li>정확한 민원상담을 위해 다음의 정보를 입력해주셔야 하며 필요시 선택항목을 입력할 수 있습니다.</li>
            				<li>※ 글 등록 시 수집하는 개인정보의 범위</li>
            				<li>- 필수항목 : 성명, 연락처(일반전화 또는 핸드폰번호), 이메일주소, 비밀번호</li>
            				<li>- 선택항목 : 없음</li>
            
            				<li>※ 개인정보의 수집목적 및 이용목적</li>
            				<li>① <?=$system['site']['author']?>은(는) 다음과 같은 목적을 위하여 개인정보를 수집하고 있습니다.</li>
            				<li>- 성명, 연락처(일반전화 또는 핸드폰번호), 비밀번호 : 대관신청에 따른 본인 식별 절차에 이용</li>
            				<li>② 단, 이용자의 기본적 인권 침해의 우려가 있는 민감한 개인정보 (인종 및 민족, 사상 및 신조, 정치적 성향 및 범죄기록 등)는 수집하지 않습니다.</li>
            
            				<li>※ 개인정보의 보유기간 및 이용기간</li>
            				<li><?=$system['site']['author']?>은(는) 수집된 개인정보의 보유기간은 글 등록 후 일정기간 동안 보유할 수 있습니다.</li>
            			</ul>
        			</li>
        		</ul>
        	</div>
        </div>
        
        
        <div class="agreeokbtn">
        	<div class="group-check">
        		<span class="tmp-check"> <input type="checkbox" name="agreeok" value="1" id="agreeok" checked=""> <label for="agreeok" title="동의"><span></span>동의
        		</label>
        		</span>
        	</div>
        </div>
        
    	
    	<div class="btnbox text-center">
    		<a href="<?=getBackUrl("menu|pno|category|limit|no|sfv|opt")?>&mode=calendar" class="btn btn-default">이전</a>
    		<input type="submit" class="btn btn-enter" value="확인" />
    		<input type="hidden" name="backUrl" value="<?=getBackUrl("menu|pno|category|limit|sfv|opt", 1)?>" />
    		<input type="hidden" name="no" value="<?=$no?>" />
    		<input type="hidden" name="reservation_type" value="<?=$dbData[0]['reservation_type']?>" />
    		<input type="hidden" name="date" value="<?=$_GET['date']?>" />
    		<input type="hidden" name="time" value="<?=$time?>" />
    		<?php if($dbData[0]['reservation_type'] == 1){?>
    		<input type="hidden" name="time2" value="<?=$time2?>" />
    		<input type="hidden" name="time3" value="<?=$time3?>" />
    		<?php }?>
    		<input type="hidden" name="menu" value="<?=$menuID?>" />
    	</div>
	</div>
</form>
