<?php
include('../helpers.php');

$lines = file('1.txt');
printMsg('File read done');
$res = [0];
$i = 0;
foreach($lines as $line){
	$val = intval($line);
	if($val > 0){
		$res[$i]+=$val;
	} else {
		$i++;
		$res[$i] = 0;
	}
}
printMsg('Summed');
rsort($res);
printMsg('And now for the results');
printMsg('Max: ' . $res[0]);
$part = array_slice($res, 0, 3);
printMsg('Sum top 3: ' . array_sum($part));
printEnd();