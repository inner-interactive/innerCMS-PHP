<table class="table_basic th-g">
	<caption>사이트 리스트</caption>
	<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">DIRECTORY</th>
			<th scope="col">사이트 이름</th>
			<th scope="col">생성일</th>
			<th scope="col">메뉴정보</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$i = 0;
		foreach($system['siteList'] as $site_key => $value){
	    ?>
		<tr<?=$site_key == $siteKey ? " class=\"depth1\"" : "" ?>>
			<td scope="row"><?=$i+1?></td>
			<td><a href="<?=getBackUrl("menu")?>&amp;mode=list&amp;site=<?=$site_key?>"><strong><?=$site_key?></strong></a> </td>
			<td><?=$value['author']?></td>
			<td><?=$value['build']?></td>
			<td><a href="#" target="_blank"><?=$site_key?></a></td>
		</tr>
		<?php 
		$i++;
		}?>
	</tbody>
</table>

<div class="mt30 mb20" style="overflow: hidden">
	<div style="float:right">
		<a class="btn btn_apply" href="<?=getBackUrl("menu|site")?>&amp;mode=write">메뉴등록</a>
		<a class="btn btn_apply" href="<?=getBackUrl("menu|site")?>&amp;mode=arrange">메뉴순서정렬</a>
	</div>
	
	<div class="search" style="float:left">
		<fieldset>
			<legend>검색</legend>
			<span class="item"><input name="sv" type="text" id="menuSearch" value="<?=isset($_COOKIE['menukeyword']) ? $_COOKIE['menukeyword'] : ""?>" class="iText w300" placeholder="검색어를 입력하세요(메뉴명, 스킨명 등)"></span>
		</fieldset>
	</div>
</div>


<table class="table_basic menulist">
	<caption><?php echo $siteList[$siteKey]['author']?> 메뉴 리스트</caption>
	<thead>
		<tr>
			<th rowspan="2">메뉴값</th>
			<th rowspan="2">메뉴명</th>
			<th rowspan="2">메뉴타입</th>
			<th rowspan="2">메뉴차수</th>
			<th rowspan="2">하위메뉴</th>
			<th rowspan="2">페이지바디</th>
			<th rowspan="2">메뉴새창</th>
			<th rowspan="2">게시판스킨명/버전이력</th>
			<th colspan="3">메뉴숨김</th>
			<th rowspan="2">수정</th>
			<th rowspan="2">삭제</th>
		</tr>
		<tr>
			<th>대메뉴</th>
			<th>사이드메뉴</th>
			<th>사이트맵</th>
		</tr>
	</thead>
	<tbody id="menuTable">
	<?php $menuInfo->getMenuList()?>
	</tbody>
</table>

<div class="function mt30">
	<a class="btn btn_apply" href="<?=getBackUrl("menu|site")?>&amp;mode=write">메뉴등록</a>
	<a class="btn btn_apply" href="<?=getBackUrl("menu|site")?>&amp;mode=arrange">메뉴순서정렬</a>
</div>
