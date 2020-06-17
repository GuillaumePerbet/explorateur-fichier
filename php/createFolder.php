<?php

$url = $_POST["url"].DIRECTORY_SEPARATOR.$_POST["folderName"];
if(!is_dir($url)){
    mkdir($url);
}