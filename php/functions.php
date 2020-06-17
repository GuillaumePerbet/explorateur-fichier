<?php

//take directory url
//change directory
//return array of files inside directory
function getDirectoryContent($url){
    //go to directory
    chdir($url);
    //scan directory
    $content = scandir(getcwd());
    //remove . et .. files
    return array_diff($content, array('..', '.'));
}

//take array of files name
//print array of html components in JSON format
function printDirectoryContent($content){
    $response = [];
    foreach($content as $file){
        // check if item is a file or a folder
        if (is_dir($file)){
            $type = "folder";
            $event = "navigate(".json_encode(getcwd() . DIRECTORY_SEPARATOR . $file).")";
        }else{
            $type = "file";
            $event = "";
        }
    
        // add component to $response
        array_push($response,
        "<figure class='item' onclick='$event'>
            <img src='media/$type.png' alt='$type' width='225' height='225'>
            <figcaption>$file</figcaption>
        </figure>"
        );
    }
    echo json_encode($response);
}