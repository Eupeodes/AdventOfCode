<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D2 extends Day{
	private $dataFile = __DIR__.'/D2.txt';
	private $deltas = [];
	public function __construct(){
	}
	
	private function isSave($numbers){
		if(count($numbers) < 2){
			return true;
		}
		$this->deltas = [];
		for($n=1;$n<count($numbers);$n++){
			$this->deltas[] = $numbers[$n] - $numbers[$n -1];
		}
		if((min($this->deltas) >= 1 && max($this->deltas) <= 3) || (min($this->deltas) >= -3 && max($this->deltas) <= -1)){
			return true;
		}
		return false;
	}
	
	private function dampener($numbers){
		$dist = array_keys(array_count_values($this->deltas));
		sort($dist);
		if(max(array_slice($dist, 0, 2)) < -3 || min(array_slice($dist, -2)) > 3){
			return false;
		}
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