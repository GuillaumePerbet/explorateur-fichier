<?php

//FILES MANAGEMENT

//open directory at url and return array of content
function getDirectoryContent($url){
    //go to directory
    chdir($url);
    //scan directory
    $content = scandir(getcwd());
    //remove . et .. files
    return array_diff($content, array('..', '.'));
}

//create file at url
function createFile($url){
    $file = fopen($url,'w');
    fclose($file);
}

//create folder at url
function createFolder($url){
    mkdir($url);
}

//remove file at url (and content recursively)
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

//copy file at source url (and content recursively) to target url
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




//PRINT CONTENT

//take url
//print array of breadcrumb components
function printBreadcrumb($url){
    $path = explode(DIRECTORY_SEPARATOR,$url);
    $startPath = false;
    $response=[];
    $url = "";
    foreach($path as $item){
        $url = $url . $item;
        // start printing at "Home" directory
        if($item == "Home"){
            $startPath = true;
        }
        if($startPath){
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
}


//take array of files name
//print array of html components
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
            <div class='fileControls flex between'>
                <button class='iconBtn bin' onclick='deleteFile(event,$url)'></button>
                <button class='iconBtn copy' onclick='copyFile(event,$url,".json_encode($file).")'></button>
                <button class='iconBtn cut' onclick='cutFile(event,$url,".json_encode($file).")'></button>
            </div>
        </figure>"
        );
    }
    echo json_encode($response);
}

//print file content at url
function printFileContent($url){
    $size = filesize($url);
    if ($size>0){
        $file = fopen($url,"r");
        $response = json_encode(fread($file,filesize($url)));
        fclose($file);
    }else{
        $response = json_encode("Le fichier est vide");
    }
    echo $response;
}