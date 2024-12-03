<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D3 extends Day{
	private $dataFile = __DIR__.'/D3.txt';
	public function __construct(){
	}
	
	public function run(){
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		$f = fopen($this->dataFile, 'r');
		$escape = false;
		while($line = fgets($f)){
			preg_match_all('/mul\((?P<a>[0-9]{1,3}),(?P<b>[0-9]{1,3})\)/', $line, $matches);
			foreach($matches['a'] as $i=>$v){
				$this->solution_1 += $v * $matches['b'][$i];
			}
			if($escape){
				$line = preg_replace('/^.*do\(\)/U', '', $line);
			}
			$escaped = preg_replace('/don\'t\(\).*do\(\)/U', '', $line);
			$escaped2 = preg_replace('/don\'t\(\).*$/U', '', $escaped);
			if($escaped != $escaped2){
				$escape = true;
			}
			preg_match_all('/mul\((?P<a>[0-9]{1,3}),(?P<b>[0-9]{1,3})\)/', preg_replace('/don\'t\(\).*(do\(\)|$)/U', '', $line), $matches);
			foreach($matches['a'] as $i=>$v){
				$this->solution_2 += $v * $matches['b'][$i];
			}
		}
	}
}