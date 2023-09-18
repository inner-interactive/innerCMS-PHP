<?php
$blankList = array(
    "subject|제목을",
    "memo|내용을"
);
blankCheck($blankList);

term_check($_POST['date1'], $_POST['date2']);
$_POST['f1'] = isset($_POST['f1']) && count($_POST['f1']) > 0 ? implode("|", $_POST['f1']) : "";
if (isset($_POST['f2']) && count($_POST['f2']) > 0) {
    $_POST['f2'] = array_unique($_POST['f2']);
    $_POST['f2'] = implode("|", $_POST['f2']);
} else
    $_POST['f2'] = "";

?>