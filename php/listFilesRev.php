<?php
require_once("functions.php");

$content = getDirectoryContent($_POST["url"]);
$contentReverse = array_reverse($content);
printDirectoryContent($contentReverse);