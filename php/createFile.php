<?php

$url = $_POST["url"].DIRECTORY_SEPARATOR.$_POST["fileName"];
if(!is_file($url)){
    $file = fopen($url,'w');
    fclose($file);
}