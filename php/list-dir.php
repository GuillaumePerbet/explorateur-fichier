<?php

// 1 - Afficher le contenu du répertoire 
$url = getcwd(); 
$content=scandir($url);

print_r($content);

foreach($content as $item ){
	echo $item."<br />";
}
?>