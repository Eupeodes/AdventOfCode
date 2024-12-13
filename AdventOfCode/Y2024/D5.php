<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D5 extends Day{
	private $dataFile = __DIR__.'/D5.txt';
	private $pages = [];
	private $lines = [];
	public function __construct(){
	}
	
	private function isCorrect($parts){
		$check = [];
		for($i=count($parts)-1;$i>=0;$i--){
			$part = (int)$parts[$i];
			foreach($check as $p){
				if(!in_array($p, $this->pages[$part])){
					return false;
				}
			}
			$check[] = $part;
		}
		return true;
	}
	
	private function makeCorrect($parts){
		$placed = [];
		foreach($parts as $part){
			$done = false;
			foreach($placed as $i=>$v){
				if(in_array($part, $this->pages[$v])){
					array_splice($placed, $i, 0, [$part]);
					$done = true;
					break;
				}
			}
			if(!$done){
				$placed[] = $part;
			}
		}
		return array_reverse($placed);
	}
	
	public function run(){
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			if(strpos($line, '|')){
				list($a, $b) = explode('|', trim($line));
				if(!array_key_exists($a, $this->pages)){
					$this->pages[$a] = [$b];
				} else {
					$this->pages[$a][] = $b;
				}
				if(!array_key_exists($b, $this->pages)){
					$this->pages[$b] = [];
				}
			} else {
				$parts = explode(',', trim($line));
				if(count($parts) > 1){
					if($this->isCorrect($parts)){
						$this->solution_1 += $parts[(count($parts)-1)/2];
					} else {
						$parts = $this->makeCorrect($parts);
						if(!$this->isCorrect($parts)){
							var_dump($parts);
						}
						$this->solution_2 += $parts[(count($parts)-1)/2];
					}
				}
			}
		}
	}
}