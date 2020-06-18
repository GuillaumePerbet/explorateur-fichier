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
        $url = json_encode(getcwd() . DIRECTORY_SEPARATOR . $file);
        // check if item is a file or a folder
        if (is_dir($file)){
            $type = "folder";
            $event = "navigate($url)";
        }else{
            $type = "file";
            $event = "openFile($url)";
        }
    
        // add component to $response
        array_push($response,
        "<figure class='item' onclick='$event'>
            <img src='media/$type.png' alt='$type' width='225' height='225'>
            <figcaption>$file</figcaption>
        </figure>
        <button onclick='deleteFile($url)'>Supprimer</button>
        <button onclick='copyFile($url,".json_encode($file).")'>Copier</button>
        <button onclick='cutFile($url,".json_encode($file).")'>Couper</button>"
        );
    }
    echo json_encode($response);
}

//take file url
//remove file and all content recursively
function deleteFile($url){
    if (is_file($url)){
        unlink($url);
    }else{
        $content = getDirectoryContent($url);
        foreach($content as $file){
            deleteFile($url . DIRECTORY_SEPARATOR . $file);
        }
        rmdir($url);
    }
}