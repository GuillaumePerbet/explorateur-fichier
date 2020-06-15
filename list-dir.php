<?php

// 1 - Afficher le contenu du répertoire 
$url = getcwd(); 
$content=scandir($url);

foreach($content as $item ){
	if($item !== "." && $item !== ".."){
		echo $item."<br />";
	}
}