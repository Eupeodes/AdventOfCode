<?php

$strings = file('5.txt');

function isNice ($str){
	preg_match_all('/[aeiuo]/', $str, $matches);
	if(count($matches[0]) < 3){
		return false;
	}
	preg_match_all('/(ab|cd|pq|xy)/', $str, $matches);
	if(count($matches[0]) > 0){
		return false;
	}
	$chars = str_split($str);
	$prev = '';
	foreach($chars as $char){
		if($char == $prev){
			return true;
		}
		$prev = $char;
	}
	return false;
}

function isNice2($str){
	$chars = str_split($str);
	$prev = '';
	$pprev = '';
	$chunks = [];
	$repeat = false;
	$duo = false;
	foreach($chars as $char){
		$str = $prev.$char;
		$p = array_search($str, $chunks);
		if($p && $p < count($chunks)-1){
			$duo = true;
		}
		$chunks[] = $str;
		if($char == $pprev){
			$repeat = true;
		}
		$pprev = $prev;
		$prev = $char;
	}
	return ($repeat && $duo);
}

$res = [
	'nice' => 0,
	'naughty' => 0
];
foreach($strings as $str){
	$res[isNice2($str) ? 'nice' : 'naughty']++;
}
var_dump($res);