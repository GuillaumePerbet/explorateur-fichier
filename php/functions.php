<?php
// take array of JSON items with "name" and "isFolder" attributes
// print html figure for each item
function printItems($list){
    $list = json_decode($list);
    foreach($list as $item){
        if ($item->isFolder){
            $type = "folder";
        }else{
            $type = "file";
        }
        $name = $item->name;

        echo "<figure class='item'>
            <img src=media/$type.png alt=$type>
            <figcaption>$name</figcaption>
        </figure>";
    }
}

// take directory URL
// print breadcrumb
function breadcrumb($url){
    // split URL
    $path = explode(DIRECTORY_SEPARATOR,$url);
    $print = false;
    foreach($path as $item){
        // start printing at "home" directory
        if($item == "home"){
            $print = true;
        }
        if($print){
            echo "<li><a href='#'>$item</a></li>";
        }
    }
}