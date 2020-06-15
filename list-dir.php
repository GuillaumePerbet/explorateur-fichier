<?php
// 1 et 3 - Return items of current directory in JSON
// "name" : item name string
// "isFolder" : boolean

$url = getcwd();
$content = scandir($url);
$response = [];

foreach($content as $item ){
	// hide useless entries of $content
	if($item !== "." && $item !== ".."){
		// add item to $response
		array_push($response, ["name"=>$item, "isFolder"=>is_dir($item)]);
	}
}

echo json_encode($response);