<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D1 extends Day{
	private $dataFile = __DIR__.'/D1.txt';
	public function __construct(){
	}
	
	public function run(){
		$left = [];
		$right = [];
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			$parts = explode('   ', $line);
			$left[] = $parts[0];
			$right[] = trim($parts[1]);
		}
		sort($left);
		sort($right);
		$counts = array_count_values($right);
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		foreach($left as $i=>$n){
			$this->solution_1 += abs($n - $right[$i]);
			@$this->solution_2 += $n * $counts[$n];
		}
	}
}