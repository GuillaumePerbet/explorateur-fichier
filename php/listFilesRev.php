<?php
require_once("functions.php");

$url = $_POST["url"];
$content = getDirectoryContent($url);
$contentReverse = array_reverse($content);
printDirectoryContent($contentReverse);