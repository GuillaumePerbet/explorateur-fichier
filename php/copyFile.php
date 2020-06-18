<?php

require_once("functions.php");

copyFile($_POST["sourceUrl"],$_POST["currentUrl"].DIRECTORY_SEPARATOR.$_POST["fileName"]);