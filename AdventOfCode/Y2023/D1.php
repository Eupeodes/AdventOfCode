<?php

namespace Eupeodes\AdventOfCode\Y2023;

use Eupeodes\AdventOfCode\Day;

class D1 extends Day{
	private $dataFile = __DIR__.'/D1.txt';
	public function __construct(){
	}
	
	private $replaces = [
		'one' => 1,
		'two' => 2,
		'three' => 3,
		'four' => 4,
		'five' => 5,
		'six' => 6,
		'seven' => 7,
		'eight' => 8,
		'nine' => 9
	];
	
	private function getValue($line){
		preg_match_all('([0-9])', $line, $matches);
		$matches = $matches[0];
		return $matches[0]*10 + $matches[count($matches)-1];
	}
	
	private function findWritenNumbers($line){
		preg_match_all('/(?=([0-9]|one|two|three|four|five|six|seven|eight|nine))/', $line, $matches);
		$matches = $matches[1];
		print_r($matches);
		return $this->writenToInt($matches[0])*10 + $this->writenToInt($matches[count($matches)-1]);
	}
	
	private function writenToInt($n){
		if(array_key_exists($n, $this->replaces)){
			return $this->replaces[$n];
		}
		return $n;
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		while($line = fgets($f)){
			$value = $this->getValue($line);
			$this->solution_1 += $value;
			$value2 = $this->findWritenNumbers($line);
			$this->solution_2 += $value2;
		}
	}
}