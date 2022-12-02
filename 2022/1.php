<?php
$start = microtime(true);
function printMsg($msg){
	echo date('H:i:s').' | '.$msg . "\n";
}
printMsg('Start');
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
echo 'Max: ' . $res[0] . "\n";
$part = array_slice($res, 0, 3);
echo 'Sum top 3: ' . array_sum($part) . "\n";
printMsg('Done in '.(microtime(true)-$start));