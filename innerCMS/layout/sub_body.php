<section id="Wrap">


	<div class="titleroad">
		<h2>문서 위치</h2>
		<ul class="Position">
			<li><a href="./" title="메인으로 이동"><img src="img/inc/home.png" /></a></li>
			<li><?=$system['menu']['position']?></li>
		</ul>
	</div>

	<div id="contwrap">

		<div id="Leftbox" class="sidebar">
			<h3 class="menutitle"><?=$system['data']['position'][count($system['data']['position']) - 1]['menu_title']?></h3>
			<div class="leftmenu"><?=$system['menu']['lnb']?></div>
		</div>

		<h2>본문내용</h2>
		<div id="Start">

			<div class="container">

				<h3 class="Subtitle"><?=$system['data']['position'][0]['menu_title']?></h3>
				<?php 
				$page_file = getPageFile($system['data']['menu']);
				if ($page_file != "" && file_exists($page_file)) {
				    include $page_file;
				}
				?>
			</div><!-- container 종료 -->

		</div><!-- Start 종료 -->

	</div><!-- contwrap 종료 -->

</section><!-- Wrap 종료 -->

