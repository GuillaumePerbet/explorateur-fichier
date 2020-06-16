<?php

$path = explode(DIRECTORY_SEPARATOR,$_POST["url"]);
$print = false;
$response=[];
foreach($path as $item){
    // start printing at "home" directory
    if($item == "home"){
        $print = true;
    }
    if($print){
        array_push($response,"<li><a href='#'>$item</a></li>");
    }
}

echo json_encode($response);