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