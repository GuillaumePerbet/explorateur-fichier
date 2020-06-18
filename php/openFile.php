<?php

$url = $_POST["url"];
$size = filesize($url);
if ($size>0){
    $file = fopen($url,"r");
    $response = json_encode(fread($file,filesize($url)));
}else{
    $response = json_encode("Le fichier est vide");
}

echo $response;