<?php
require_once("functions.php");

$newFileUrl = $_POST["url"].DIRECTORY_SEPARATOR.$_POST["fileName"];

if(file_exists($newFileUrl)){
    //error message
}else{
    createFile($newFileUrl);
}