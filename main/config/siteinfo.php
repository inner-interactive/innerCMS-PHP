<?php
if (! defined("BASE_PATH")) exit("No direct script access allowed");
$site = array();
$site["author"] = "사이트명입력";
$site["description"] = "";
$site["keyword"] = "";
$site["build"] = "2020-03-06";
$site["email"] = "";
$site["maincss"] = "jscss/main.css";
$site["subcss"] = "jscss/sub.css";
$system["site"] = $site;
unset($site);