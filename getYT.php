<?php
$url = $_GET['list'];
$url = filter_var($url, FILTER_SANITIZE_STRING);

$cmd="./getYT.sh '$url'";
system("$cmd");

?>
