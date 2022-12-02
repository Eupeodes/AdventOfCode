<?php

$data = str_split(file_get_contents('3.txt'));
$x = 0;
$y = 0;
$res = ['0|0' => 1];
$pos = [
	['x' => 0, 'y' => 0],
	['x' => 0, 'y' => 0]
];
foreach($data as $i=>$step){
	$who = $i % 2;
	switch($step){
		case '^':
			$pos[$who]['y']++;
			break;
		case 'v':
			$pos[$who]['y']--;
			break;
		case '<':
			$pos[$who]['x']--;
			break;
		case '>':
			$pos[$who]['x']++;
			break;
	}
	$key = $pos[$who]['x'] . '|' . $pos[$who]['y'];
	if(array_key_exists($key, $res)){
		$res[$key]++;
	} else {
		$res[$key] = 1;
	}
}
echo count($res). "\n";