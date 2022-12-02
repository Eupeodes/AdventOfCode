<?php
$lines = file('2.txt');

$mapping = [
	'opp' => [
		'A' => 1, //rock
		'B' => 2, //paper
		'C' => 3  //scissors
	],
	'you' => [
		'X' => 1, //rock
		'Y' => 2, //paper
		'Z' => 3  //scissors
	]
];

// $outcomes[you][opp]
$outcomes = [
	1 => [
		1 => 3,
		2 => 0,
		3 => 6
	], 
	2 => [
		1 => 6,
		2 => 3,
		3 => 0
	], 
	3 => [
		1 => 0,
		2 => 6,
		3 => 3
	]
	];

$target = [
	'1' => [
		'X' => 3,
		'Y' => 1,
		'Z' => 2
	],
	2 => [
		'X' => 1,
		'Y' => 2,
		'Z' => 3
	],
	3 => [
		'X' => 2,
		'Y' => 3,
		'Z' => 1
	]
	];
	
function calcResult($you, $opponent){
	global $mapping, $outcomes;
	$sy = $mapping['you'][$you];
	$so = $mapping['opp'][$opponent];
	$outcome = $outcomes[$sy][$so];
	return $outcome + $sy;
}

function calcResult2($you, $opponent){
	global $mapping, $outcomes, $target;
	$so = $mapping['opp'][$opponent];
	$sy = $target[$so][$you];
	$outcome = $outcomes[$sy][$so];
	return $outcome + $sy;
}

$score = 0;
foreach($lines as $line){
	list($opponent, $you) = explode(' ', trim($line));
	$score += calcResult2($you, $opponent);
}
echo $score . "\n";