<?php
$lines = file('1.txt');
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
rsort($res);
echo 'Max: ' . $res[0] . "\n";
$part = array_slice($res, 0, 3);
echo 'Sum top 3: ' . array_sum($part) . "\n";
