<?php
require_once("functions.php");

$targetUrl = $_POST["currentUrl"].DIRECTORY_SEPARATOR.$_POST["fileName"];

if(file_exists($targetUrl)){
    //error message
}else{
    copyFile($_POST["sourceUrl"],$targetUrl);
}