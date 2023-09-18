<!doctype html>
<html lang="ko">
<head>
<!-- Page Title -->
<title>PDF 뷰어</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="telephone=no" />
<meta name="robots" content="index, follow" />
</head>
<body>
<?php
$pdf_file = $_GET['pdf'];
if ($pdf_file != "") {
    ?>
<iframe src="../common/plugin/pdfjs/web/viewer.html?file=<?=$pdf_file?>"
		width="1200" height="800" frameborder="0" title="PDF 뷰어"></iframe>
<?php }?>
</body>
</html>