<?php

//3 - Faire en sorte que .. et . n’apparaissent pas

$display_files = [];
foreach(
	$content as $item 
){
	if($item !== "." && $item !== ".."){
		echo $item."<br />";
	}
}
?>