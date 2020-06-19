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
            <div class='fileControls flex justify-center'>
                <button class='deleteBtn' onclick='deleteFile(event,$url)'></button>
                <button class='copyBtn' onclick='copyFile(event,$url,".json_encode($file).")'>Copier</button>
                <button class='cutBtn' onclick='cutFile(event,$url,".json_encode($file).")'>Couper</button>
            </div>
        </figure>"
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

//take source url and target url
//copy file and content recursively
function copyFile($sourceUrl, $targetUrl){
    if(is_file($sourceUrl)){
        copy($sourceUrl, $targetUrl);
    }else{
        mkdir($targetUrl);
        $sourceContent = getDirectoryContent($sourceUrl);
        foreach($sourceContent as $source){
            copyFile($sourceUrl.DIRECTORY_SEPARATOR.$source,$targetUrl.DIRECTORY_SEPARATOR.$source);
        }
    }
}