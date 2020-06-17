<?php
require_once("functions.php");

$url = $_POST["url"];
$content = getDirectoryContent($url);
printDirectoryContent($content);