<?php
$data = array(
    'src' => ''
);

if ($_POST['url'] != "") {
    // echo $_POST['url'];

    $url = strtolower(trim($url));

    $parse = parse_url($_POST['url']);
    $scheme = isset($parse['scheme']) ? trim($parse['scheme']) : "http";
    $scheme .= "://";
    $host = trim($parse['host']);
    $favicon_url = $scheme . $host . "/favicon.ico";

    $fp = @GetImageSize($favicon_url);

    if ($fp) {
        $data['src'] = $favicon_url;
    }
}

echo json_encode($data);
?>