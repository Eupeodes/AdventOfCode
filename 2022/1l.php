<?php

//rewrite for ling file from tweakers.net

include('../helpers.php');

$f = fopen('1l.txt', 'r');
printMsg('Starting loop');
$res = [0,0,0];
$e = 0;
while($line = fgets($f)){
	$val = intval($line);
	if($val > 0){
		$e += $val;
	} else {
		$res[] = $e;
		$e = 0;
		rsort($res);
		$res = array_slice($res, 0, 3);
	}
}
printMsg('Summed');
printMsg('And now for the results');
printMsg('Max: ' . $res[0]);
printMsg('Sum top 3: ' . array_sum(array_slice($res, 0, 3)));
printEnd();