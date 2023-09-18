<?php 
//총 회원수
$query = "SELECT count(*) FROM ".MEMBER_TABLE;
$dbData = $DB->getDBData($query);
$infoData['member'] = intval($dbData[0][0]);
	
//총 방문자수
$query = "SELECT count(*) FROM ".VISIT_TABLE;
$dbData = $DB->getDBData($query);
$infoData['visitor'] = intval($dbData[0][0]);
	
//신규 가입회원
$yesterday = date("Y-m-d H:i:s", strtotime("-1 day"));
$query = "SELECT count(*) FROM ".MEMBER_TABLE." WHERE jointime >= '{$yesterday}'";
$dbData = $DB->getDBData($query);
$infoData['join'] = intval($dbData[0][0]);

//서버 용량
$bytes = disk_free_space(".");
$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
$base = 1024;
$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
$serverVolume = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];

//오늘 방문자수
$today = date("Y-m-d");
$query = "SELECT count(*) FROM ".VISIT_TABLE." WHERE vi_date BETWEEN '".$today."' AND '".$today."'";
$dbData = $DB->getDBData($query);
$infoData['today'] = intval($dbData[0][0]);

//주간 방문자수
$today_w = date("w");
$sunday = date("Y-m-d", strtotime(" -".$today_w."days"));
$query = "SELECT count(*) FROM ".VISIT_TABLE." WHERE vi_date BETWEEN '".$sunday."' AND '".$today."'";
$dbData = $DB->getDBData($query);
$infoData['week'] = intval($dbData[0][0]);

//월간 방문자수
$query = "SELECT count(*) FROM ".VISIT_TABLE." WHERE vi_date BETWEEN '".date("Y-m")."-01' AND '".$today."'";
$dbData = $DB->getDBData($query);
$infoData['month'] = intval($dbData[0][0]);

//연간 방문자수
$query = "SELECT count(*) FROM ".VISIT_TABLE." WHERE vi_date BETWEEN '".date("Y")."-01-01' AND '".$today."'";
$dbData = $DB->getDBData($query);
$infoData['year'] = intval($dbData[0][0]);

function getPadNumToText($num = 0, $pad = 4){
	$pad_num = str_pad($num, $pad, "0", STR_PAD_LEFT);
	$html = "";
	for($i = 0; $i < strlen($pad_num); $i++){
		$html .= "<span>".substr($pad_num, $i, 1)."</span>";
	}
	return $html;
}


//팝업현황
$query = "SELECT menu_id FROM ".MENU_TABLE." WHERE site = 'innerCMS' AND route = 'popup'";
$dbData = $DB->getDBData($query);
$popupMenuID = intval($dbData[0]['menu_id']);

$query = "SELECT * FROM ".POPUP_TABLE." ORDER BY writetime DESC LIMIT 5";
$popupData = $DB->getDBData($query);



//방문자 현황 - 일일
$query = "SELECT left(convert(vi_time, CHAR), 2) AS time FROM ".VISIT_TABLE." WHERE vi_date = '{$today}'";
$dbData = $DB->getDBData($query);

$visitDays = array();
for($i = 0; $i < 24; $i++){
	$visitDays[sprintf('%02d', $i)] = 0;
}
foreach($dbData as $value){
	$visitDays[$value['time']]++;
}
$dayLabel = $dayData = "";
foreach ($visitDays as $key => $value){
	$dayLabel .= "'".$key."시'".",";
	$dayData .= $value.",";
}
$dayLabel = trim($dayLabel, ",");
$dayData = trim($dayData, ",");



//방문자현황 - 주간
$saturday = date("Y-m-d", strtotime($sunday." +6 days"));
$query = "SELECT * FROM ".VISIT_SUM_TABLE." WHERE vs_date BETWEEN '{$sunday}' AND '{$saturday}' ";
$dbData = $DB->getDBData($query);

$visitWeeks = array();
$weekLabel = $weekData = "";
for($i = strtotime($sunday); $i <= strtotime($saturday); $i += 86400){
	$visitWeeks[date("Y-m-d", $i)] = 0;
}

foreach($dbData as $value){
	$visitWeeks[$value['vs_date']] = $value['vs_count'];
}

foreach ($visitWeeks as $key => $value){
	$weekLabel .= "'".$key."'".",";
	$weekData .= $value.",";
}
$weekLabel = trim($weekLabel, ",");
$weekData = trim($weekData, ",");



//방문자현황 - 월간
$monthStart = date("Y-m-01");
$monthEnd = date("Y-m-t");
$query = "SELECT * FROM ".VISIT_SUM_TABLE." WHERE vs_date BETWEEN '".$monthStart."' AND '".$monthEnd."' ";
$dbData = $DB->getDBData($query);

$visitMonths = array();
$monthLabel = $monthData = "";
for($i = strtotime($monthStart); $i <= strtotime($monthEnd); $i += 86400){
	$visitMonths[date("Y-m-d", $i)] = 0;
}

foreach($dbData as $value){
	$visitMonths[$value['vs_date']] = $value['vs_count'];
}

foreach ($visitMonths as $key => $value){
	$monthLabel .= "'".$key."'".",";
	$monthData .= $value.",";
}
$monthLabel = trim($monthLabel, ",");
$monthData = trim($monthData, ",");
?>
<div id="Wrap">
	<div class="titleroad">
		<h2>문서 위치</h2>
		<ul class="Position">
			<li>
				<h2>총 회원수 및 총 방문자수</h2>
				<div class="countnumber">
					<dl>
						<dt>총 방문자수</dt>
						<dd><?php echo getPadNumToText($infoData['visitor'])?>명</dd>
						<dt>오늘 방문자수</dt>
						<dd><?php echo getPadNumToText($infoData['today'])?>명</dd>
						<dt>주간 방문자수</dt>
						<dd><?php echo getPadNumToText($infoData['week'])?>명</dd>
						<dt>월간 방문자수</dt>
						<dd><?php echo getPadNumToText($infoData['month'])?>명</dd>
						<dt>연간 방문자수</dt>
						<dd><?php echo getPadNumToText($infoData['year'])?>명</dd>
					</dl>
				</div>
			</li>
		</ul>
	</div>
	
	
	<div id="contwrap">
		<div id="Leftbox">
			<h2>사용자정보</h2>
			<div class="name">
				<strong><b><?=$_SESSION["user_uname"]?></b>님</strong><span>로그인하셨습니다.</span>
			</div>
			<div class="information">
				<ul>
					<li><span>오픈일</span><strong><?=str_replace("-", ".", $system["site"]["build"])?></strong></li>
					<li><span>총회원수</span><strong><?=number_format($infoData["member"])?>명</strong></li>
					<li><span>신규회원</span><strong><?=number_format($infoData["join"])?>명</strong></li>
					<li><span>호스팅기간</span><strong><?=str_replace("-", ".", $system["site"]["build"])?> ~</strong></li>
					<li><span>서버용량</span><strong><?=$serverVolume?></strong></li>
				</ul>
			</div>
		</div>
		<h2>본문내용</h2>
		<div id="Start">
			<div class="container">
				<p class="Subtitle">홈페이지 현황</p>
				<div>
					<table class="table_basic th-g">
						<thead>
							<tr>
								<th scope="col">DIRECTORY</th>
								<th scope="col">사이트 이름</th>
								<th scope="col">총 게시물 개수</th>
								<th scope="col">총 등록 메뉴 개수</th>
								<th scope="col">총 첨부파일 개수</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 0;
							foreach($system['siteList'] as $site_key => $value){
								
								if($site_key == 'innerCMS') continue;
								
								//총 등록 메뉴 개수
								$query = "SELECT count(*) FROM ".MENU_TABLE." WHERE site = '".$site_key."'";
								$dbData = $DB->getDBData($query);
								$menuCount = intval($dbData[0][0]);
								
								//총 게시물 개수
								$articleTotal = 0;
								$query = "SELECT db_table FROM ".MENU_TABLE." WHERE site = '".$site_key."' AND db_table != ''";
								$dbTableData = $DB->getDBData($query);
								
								foreach($dbTableData as $table){
									
									//테이블이 존재 하는지 확인
									$query = "SHOW TABLES LIKE '".$table['db_table']."'";
									$dbData = $DB->getDBData($query);
									if(count($dbData)){
										$query = "SELECT count(*) FROM ".$table['db_table'];
										$dbData = $DB->getDBData($query);
										$articleTotal += intval($dbData[0][0]);
									}
									
								}
								
								//총 첨부파일 개수
								$query = "SELECT COUNT(*) FROM ".MENU_TABLE." AS a, ".FILE_TABLE." AS b WHERE a.menu_id = b.menu_id AND b.attach_type = 'files' AND a.site = '{$site_key}'";
								$fileData = $DB->getDBData($query);
								$attachFileCount = intval($fileData[0][0]);
								
						    ?>
							<tr>
								<td><strong><?=$site_key?></strong></td>
								<td><?=$value['author']?></td>
								<td><?=number_format($articleTotal)?>개</td>
								<td><?=$menuCount?>개</td>
								<td><?=number_format($attachFileCount)?>개</td>
							</tr>
							<?php 
							$i++;
							}?>
						</tbody>
					</table>
				</div>
				
				
				<p class="Subtitle mt60">팝업 현황
					<a href="./?menu=<?=$popupMenuID?>" class="in_btn btn_view float-right">더보기</a>
				</p>
				<div>
					<table class="table_basic th-g">
						<thead>
							<tr>
								<th scope="col">사이트</th>
								<th scope="col">제목</th>
								<th scope="col">팝업형태</th>
								<th scope="col">팝업기간</th>
								<th scope="col">팝업상태</th>
								<th scope="col">보기</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach($popupData as $value){
								
								$_stop = $value['isstop'] == 1 ? true : false;
								$_state = "";
								if($_stop == false)
								{
									if($value['start_date'] <= $today && $value['end_date'] >= $today){
										$_stop = false;
									}else{
										$_stop = true;
										$_state = "기간아님";
									}
								}else{
									$_state = "팝업중지";
								}
								$_viewLink = "./?menu=".$popupMenuID."&amp;mode=view&amp;no=".$value['pop_id'];
						    ?>
							<tr>
								<td><strong><?=$system['siteList'][$value['site']]['author']?></strong></td>
								<td><a href="<?=$_viewLink?>"><?=$value['subject']?></a></td>
								<td><?=$value['pop_type'] == 'popup' ? '팝업창' : '레이어'?></td>
								<td><?=$value['start_date']?> ~ <?=$value['end_date']?></td>
								<td><?=$_state?></td>
								<td><a href="<?=$_viewLink?>" class="in_btn btn_view">보기</a></td>
							</tr>
							<?php 
							}?>
						</tbody>
					</table>
				</div>
				
				
				
				<p class="Subtitle mt60">방문자 현황</p>
				<ul class="tabs" id="visit_tab">
					<li class="active"><a href="#" data-canvas="dayChart">일일</a></li>
					<li><a href="#" data-canvas="weekChart">주간</a></li>
					<li><a href="#" data-canvas="monthChart">월간</a></li>
				</ul>
				<div class="canvas">
					<canvas id="dayChart" width="400" height="100vh"></canvas>
					<canvas id="weekChart" width="400" height="100vh" style="display:none"></canvas>
					<canvas id="monthChart" width="400" height="100vh" style="display:none"></canvas>
				</div>
				
				<script type="text/javascript">

				jQuery(function($){
					$('#visit_tab li a').click(function(){
						$('#visit_tab li').removeClass('active');
						$(this).parent().addClass('active');
						canvas = $(this).data('canvas');
						$('.canvas').find('canvas').hide();
						$('#' + canvas).show();
						return false;
					});
				});
				
				var ctx = document.getElementById('dayChart').getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: [<?=$dayLabel?>],
				        datasets: [{
				            label: '방문자수',
				            data: [<?=$dayData?>],
				            backgroundColor: colors.sort(function(){return Math.random() - Math.random();}),
				            borderWidth: 1
				        }]
				    },
				    
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        },
				        legend: {
				            display: false
				        }
				    }
				});
				
				var ctx = document.getElementById('weekChart').getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: [<?=$weekLabel?>],
				        datasets: [{
				            label: '방문자수',
				            data: [<?=$weekData?>],
				            backgroundColor: colors.sort(function(){return Math.random() - Math.random();}),
				            borderWidth: 1
				        }]
				    },
				    
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        },
				        legend: {
				            display: false
				        }
				    }
				});
				
				var ctx = document.getElementById('monthChart').getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: [<?=$monthLabel?>],
				        datasets: [{
				            label: '방문자수',
				            data: [<?=$monthData?>],
				            backgroundColor: colors.sort(function(){return Math.random() - Math.random();}),
				            borderWidth: 1
				        }]
				    },
				    
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        },
				        legend: {
				            display: false
				        }
				    }
				});


				
				</script>
				
<!-- 				<p class="Subtitle mt60">최근 게시물 리스트</p> -->
				
			</div>
			<!-- container -->
		</div>
		<!-- Start 종료 -->
	</div>
	<!-- contwrap 종료 -->
</div>
<!-- Wrap 종료 -->
