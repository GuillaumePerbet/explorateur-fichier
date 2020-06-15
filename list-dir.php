<?php
// 1 et 3 - Return content of current directory {"name" : , "isFolder": }

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