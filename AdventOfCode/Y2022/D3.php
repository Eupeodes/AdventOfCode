<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D3 extends Day{
	private $dataFile = __DIR__.'/D3.txt';
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$chunk = [];
		while($line = fgets($f)){
			$this->solution_1 += $this->getDuplicateValue(trim($line));
			if(count($chunk) == 3){
				$this->solution_2 += $this->getGroupBatch($chunk);
				$chunk = [];
			}
			$chunk [] = str_split(trim($line));
		}
		$this->solution_2 += $this->getGroupBatch($chunk);
	}
	
	private function getGroupBatch($chunk){
		$badge = array_intersect($chunk[0], $chunk[1], $chunk[2]);
		var_dump([$chunk, $badge]);
		return $this->getPriority(array_unique($badge));
	}
	
	private function getDuplicateValue($line){
		$len = strlen($line)/2;
		$str1 = substr($line, 0, $len);
		$str2 = substr($line, $len);
		$matches = [];
		foreach(str_split($str1) as $l){
			if(strpos($str2, $l) !== false){
				$matches[] = $l;
			}
		}
		return $this->getPriority(array_unique($matches));
	}
	
	private function getPriority($res){
		$priority = 0;
		foreach($res as $l){
			$v = ord($l);
			if($v > 95){
				$v -= 96;
			} else {
				$v -= 38;
			}
			$priority += $v;
		}
		return $priority;
	}
}