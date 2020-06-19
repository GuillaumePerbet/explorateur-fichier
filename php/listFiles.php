<?php
require_once("functions.php");

$content = getDirectoryContent($_POST["url"]);
printDirectoryContent($content);