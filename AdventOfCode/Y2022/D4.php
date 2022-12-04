<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;
use Eupeodes\AdventOfCode\helpers;

class D4 extends Day{
	private $dataFile = __DIR__.'/D4.txt';
	private $separator = '|';
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$chunk = [];
		while($line = fgets($f)){
			list($range1, $range2) = explode(',', trim($line));
			$range1 = $this->rangeToArray($range1);
			$range2 = $this->rangeToArray($range2);
			if($this->doesOverlap($range1, $range2)){
				$this->solution_2++;
			}
			$range1 = $this->translateRange($range1);
			$range2 = $this->translateRange($range2);
			if(
				$this->contains($range1, $range2) || 
				$this->contains($range2, $range1) 
			){
				$this->solution_1++;
			}
		}
	}
	
	private function contains($range1, $range2){
		return strpos($range1, $range2) !== false;
	}
	
	private function translateRange($range){
		return '|'.implode($this->separator, $range).'|';
	}
	
	private function rangeToArray($range){
		list($start, $end) = explode('-', $range);
		$arr = [];
		for($i = $start; $i <= $end; $i++){
			$arr[] = $i;
		}
		return $arr;
	}
	
	private function doesOverlap($range1, $range2){
		return count(array_intersect($range1, $range2)) > 0;
	}
}