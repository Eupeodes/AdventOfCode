<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D2 extends Day{
	private $dataFile = __DIR__.'/D2.txt';
	public function __construct(){
	}
	
	private function isSave($numbers){
		$deltas = [];
		for($n=1;$n<count($numbers);$n++){
			$deltas[] = $numbers[$n] - $numbers[$n -1];
		}
		if((min($deltas) >= 1 && max($deltas) <= 3) || (min($deltas) >= -3 && max($deltas) <= -1)){
			return true;
		}
		return false;
	}
	
	private function dampener($numbers){
		for($n=0;$n<count($numbers);$n++){
			$part = array_values(array_diff_key($numbers, [$n=>'x']));
			if($this->isSave($part)){
				return true;
			}
		}
		return false;
	}
	
	public function run(){
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			$numbers = explode(' ', $line);
			if($this->isSave($numbers)){
				$this->solution_1++;
				$this->solution_2++;
			} else {
				if($this->dampener($numbers)){
					$this->solution_2++;
				}
			}
		}
	}
}