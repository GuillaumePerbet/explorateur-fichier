<?php

// get content of targeted directory
$url = $_POST["url"];
chdir($url);
$content = scandir(getcwd());
$response = [];

foreach($content as $item ){

	// hide useless entries of $content
	if($item !== "." && $item !== ".."){

		// check if item is file or folder
		if (is_dir($item)){
            $type = "folder";
        }else{
            $type = "file";
        }

		// add item to $response
		array_push($response,
		"<figure class='item' onclick=navigate(". json_encode($url . DIRECTORY_SEPARATOR . $item) . ")>
			<img src=media/$type.png alt=$type>
			<figcaption>$item</figcaption>
		</figure>"
		);
	}
}

echo json_encode($response);