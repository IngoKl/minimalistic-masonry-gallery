<?php
include('./settings.php');
include('./analytics.php');

$img = $_GET['i'];
$mimeType = mime_content_type($img);

//Simple Analytics
if ($simpleAnalytics == true) {
	addView($img);
}

//Output Image
header('Content-Type:'.$mimeType);
readfile($img);
?>
