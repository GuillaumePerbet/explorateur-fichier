<?php

$path = explode(DIRECTORY_SEPARATOR,$_POST["url"]);
$print = false;
$response=[];
$url = "";
foreach($path as $item){
    $url = $url . $item;
    // start printing at "home" directory
    if($item == "home"){
        $print = true;
    }
    if($print){
        array_push($response,
            "<li>
                >
                <a onclick='navigate(".json_encode($url).")'>
                    $item
                </a>
            </li>"
        );
    }
    $url = $url . DIRECTORY_SEPARATOR;
}

echo json_encode($response);