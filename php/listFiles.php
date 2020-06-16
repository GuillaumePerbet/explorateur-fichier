<?php

// get content of targeted directory
$url = $_POST["url"];
chdir($url);
// hide useless entries of $content
$content = array_diff(scandir(getcwd()), array('..', '.'));;
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
	"<figure class='item' onclick=$event>
		<img src=media/$type.png alt=$type>
		<figcaption>$item</figcaption>
	</figure>"
	);

}

echo json_encode($response);