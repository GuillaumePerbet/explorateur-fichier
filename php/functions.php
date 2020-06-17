<?php

//take directory url
//return array of files inside directory
function getDirectoryContent($url){
    //go to directory
    chdir($url);
    //scan directory
    $content = scandir(getcwd());
    //remove . et .. files
    return array_diff($content, array('..', '.'));
}