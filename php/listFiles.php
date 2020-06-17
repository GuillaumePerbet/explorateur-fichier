<?php
require_once("functions.php");

$url = $_POST["url"];
// get content of directory
$content = getDirectoryContent($url);
$response = [];

foreach($content as $item ){

	// check if item is file or folder
	if (is_dir($item)){
		$type = "folder";
		$event = "navigate(".json_encode($url . DIRECTORY_SEPARATOR . $item).")";
    }else{
		$type = "file";
		$event = "";
    }

	// add item to $response
	array_push($response,
	"<figure class='item' onclick='$event'>
		<img src='media/$type.png' alt='$type' width='225' height='225'>
		<figcaption>$item</figcaption>
	</figure>"
	);
}

echo json_encode($response);