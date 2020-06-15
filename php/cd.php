<?php

// cd.php change directory
// 
// receives destination as a json-encoded string

function cd($arg) {
	$dest = json_decode($arg);
	chdir($dest);
	//debug
	echo getcwd() . "\n";
}

?>