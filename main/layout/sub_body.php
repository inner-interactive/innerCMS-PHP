<?php
// 대메뉴별 이미지
$sortNum = $system['data']['position'][count($system['data']['position']) - 1]['menu_order'];
?>
<section class="subcontent">
	<div class="subg subbg<?=$sortNum?>">
		<h2>
		<?php
        if (count($system['data']['position']) > 1) {
            $sub_title = $system['data']['position'][count($system['data']['position']) - 2]['menu_title'];
        } else {
            $sub_title = $system['data']['position'][0]['menu_title'];
        }
        echo $sub_title;
        ?>
		</h2>
		<span class="line"></span>
	</div>
	<div class="subnav">
		<div class="container">
			<?=$system['menu']['lnb'];?>
			<div class="printw">
				<a class="addthis_button_url btn-b2 copy_clip" href="#"
					title="URL 공유">URL복사</a> <a
					class="addthis_button_url btn-b3 print_page" href="#" title="프린트">프린트</a>
			</div>
			<div class="hiddenoverw">
				<a class="addthis_button_url btn-b1" href="#" title="SNS 공유">공유</a>
				<span class="hiddenover"> 
    				<a class="addthis_sns_url btn-sns1 send_twitter" href="#" title="트위터 공유"></a> 
    				<a class="addthis_sns_url btn-sns2 send_facebook" href="#" title="페이스북 공유"></a> 
    				<a class="addthis_sns_url btn-sns3 send_google" href="#" title="구글 공유"></a>
				</span>
			</div>
		</div>
	</div>
</section>
<section class="contWrap">
	<div class="container">
	
		<?php if($system['menu']['third'] != ""){?>
		<div class="third-menu">
			<?=$system['menu']['third']?>
		</div>
		<?php }?>
			
		<?php if($system['menu']['fourth'] != ""){?>	
		<div class="fourth-menu">
			<?=$system['menu']['fourth']?>
		</div>
		<?php }?>
		
		<div class="contsBox">
		<?php 
        $page_file = getPageFile($system['data']['menu']);
        if ($page_file != "" && file_exists($page_file)) {
            include $page_file;
        }
        ?>
		</div>
	</div>
</section>


<div class="quickmenu">
	<div class="qucick-arr">
		<a href="#" class="top"><strong>^<br />TOP</strong></a>
	</div>
</div>
