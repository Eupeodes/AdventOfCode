<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;
use Eupeodes\AdventOfCode\helpers;

class D7 extends Day{
	private $dataFile = __DIR__.'/D7.txt';
	private $tree = [];
	private $cur = [];
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			$this->parseLine($line);
		}
		$disk = 70000000;
		$minFree = 30000000;
		$curFree = $disk - $this->tree['/']['size'];
		$needed = $minFree - $curFree;
		$this->solution_2 = $minFree;
		foreach($this->tree as $path){
			if($path['type'] == 'dir' && $path['size'] < 100000){
				$this->solution_1 += $path['size'];
			}
			if($path['size'] > $needed && $path['size'] < $this->solution_2){
				$this->solution_2 = $path['size'];
			}
		}
	}
	
	
	private function getPath($path = ''){
		$path = is_array($path) ? $path : $this->cur;
		return implode('/', $path);
	}
	
	private function parseLine($line){
		$parts = explode(' ', trim($line));
		if($parts[0] == '$'){
			if($parts[1] == 'cd'){
				if($parts[2] == '..'){
					array_pop($this->cur);
				} else {
					$this->cur[] = $parts[2];
					$key = $this->getPath();
					$this->tree[$key] = [
						'type' => 'dir',
						'size' => 0
					];
				}
			}
			//ls ignored
		} else {
			if($parts[0] == 'dir'){
				//folder
			} else {
				$key = $this->getPath() . '/' . $parts[1];
				$this->tree[$key] = [
					'type' => 'file',
					'size' => (int)$parts[0]
				];
				$this->addSizeToParent($this->cur, $parts[0]);
			}
		}
	}
	
	private function addSizeToParent($parent, $size){
		$this->tree[$this->getPath($parent)]['size'] += $size;
		if(count($parent) > 1){
			array_pop($parent);
			$this->addSizeToParent($parent, $size);
		}
	}
}