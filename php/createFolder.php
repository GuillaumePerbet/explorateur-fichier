<?php
require_once("functions.php");

$newFolderUrl = $_POST["url"].DIRECTORY_SEPARATOR.$_POST["folderName"];

if(file_exists($newFolderUrl)){
    //error Message
}else{
    createFolder($newFolderUrl);
}