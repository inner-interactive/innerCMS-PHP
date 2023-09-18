<?php
$query = "SELECT * FROM " . ORG_TABLE . " WHERE org_type = 'team' ORDER BY org_sort ASC";
$teamData = $DB->getDBData($query);
foreach ($teamData as $value) {
    $query = "SELECT * FROM " . ORG_TABLE . " WHERE org_type = 'member' AND org_parent = " . $value['org_id'];
    $memberData = $DB->getDBData($query);
    ?>
<div class="content_box mt30">
	<div class="content_sbox">
		<h5><?=$value['org_name']?></h5>
		<div class="basic-table">
			<table border="0" cellspacing="0" cellpadding="0">
				<caption><?=$value['org_name']?></caption>
				<thead>
					<tr>
						<th scope="col" style="width: 15%">성명</th>
						<th scope="col" style="width: 15%">직위</th>
						<th scope="col" style="width: 15%">전화번호</th>
						<th scope="col" style="width: 15%">이메일</th>
						<th scope="col">담당업무</th>
					</tr>
				</thead>
				<tbody>
					<?php
    if (count($memberData) > 0) {
        foreach ($memberData as $value2) {
            ?>
					<tr>
						<td><?=$value2['name']?></td>
						<td><?=$value2['position']?></td>
						<td><?=$value2['tel']?></td>
						<td><?=$value2['email']?></td>
						<td><?=nl2br($value2['work'])?></td>
					</tr>
					<?php
        }
    } else {
        ?>
					<tr>
						<td colspan="5">등록된 조직구성원이 없습니다.</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php }?>