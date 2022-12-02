<?php

$str = file_get_contents('4.txt');
$match = '000000';
$i = 0;
while(true){
	$hash = md5($str . $i);
	if(substr($hash, 0, strlen($match)) === $match){
		echo $i . "\n";
		break;
	}
	$i++;
}