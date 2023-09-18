<!-- 첨부파일 시작 -->
<?php if($grantValue['auth_filedown']){?>
	<?php
    if (count($fileData) > 0) {
        ?>
<div class="file">
	<ul>
		<li><span>첨부파일</span></li>
		<li class="allfile">
		<?php
        for ($i = 0; $i < count($fileData); $i ++) {
            $fileicon = getFileIcon($fileData[$i]['file_ext']);
            ?>
		<span class="item"> 
    		<img src="../common/img/file/<?=$fileicon['icon']?>" alt="<?=$fileicon['ext']?> 파일 이미지" /> 
    		<a href="filedown.php?menu=<?=$menuID?>&amp;no=<?=$fileData[$i]['file_id']?>" title="<?=$fileData[$i]['down_file_name']?> 파일 다운로드"><?=$fileData[$i]['down_file_name']?></a>
			<span class="fileinfo">( 파일크기 : <?=fileSizeByteToTxt($fileData[$i]['file_size'])?>, 다운로드 : <?=$fileData[$i]['file_down_count']?>회 )</span>
		</span>
			<?php
        }
        ?>
		</li>
	</ul>
</div>
<?php
    }
    ?>
<?php }?>
<!-- 첨부파일 끝 -->