<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D4 extends Day{
	private $dataFile = __DIR__.'/D4.txt';
	private $dims = ['x' => 0, 'y' => 0];
	private $data = [];
	public function __construct(){
	}
	
	private function findXMAS($x, $y){
		if($this->doFindXMAS(range($x,$x+3), array_fill(0,4,$y))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(range($x,$x+3), range($y,$y+3))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(array_fill(0,4,$x), range($y,$y+3))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(range($x,$x-3,-1), range($y,$y+3))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(range($x,$x-3, -1), array_fill(0,4,$y))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(range($x,$x-3,-1), range($y,$y-3,-1))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(array_fill(0,4,$x), range($y,$y-3,-1))){
			$this->solution_1++;
		}
		if($this->doFindXMAS(range($x,$x+3), range($y,$y-3,-1))){
			$this->solution_1++;
		}
	}
	
	private function doFindXMAS($x, $y){
		if($x[3] >= $this->dims['x'] || $x[3] < 0 || $y[3] >= $this->dims['y'] || $y[3] < 0){
			return false;
		}
		if($this->data[$x[1]][$y[1]] != 'M'){
			return false;
		}
		
		if($this->data[$x[2]][$y[2]] != 'A'){
			return false;
		}
		
		if($this->data[$x[3]][$y[3]] != 'S'){
			return false;
		}
		return true;
	}

	private function isXMAS($x, $y){
		if($x < 1 || $x >= $this->dims['x']-1 || $y < 1 || $y >= $this->dims['y']-1){
			return false;
		}
		if($this->data[$x-1][$y-1] == 'M' && $this->data[$x+1][$y+1] == 'S'){
			if($this->data[$x-1][$y+1] == 'M' && $this->data[$x+1][$y-1] == 'S'){
				return true;
			}
			if($this->data[$x-1][$y+1] == 'S' && $this->data[$x+1][$y-1] == 'M'){
				return true;
			}
		}
		if($this->data[$x-1][$y-1] == 'S' && $this->data[$x+1][$y+1] == 'M'){
			if($this->data[$x-1][$y+1] == 'M' && $this->data[$x+1][$y-1] == 'S'){
				return true;
			}
			if($this->data[$x-1][$y+1] == 'S' && $this->data[$x+1][$y-1] == 'M'){
				return true;
			}
		}
		return false;
	}
	public function run(){
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		$f = fopen($this->dataFile, 'r');
		$this->data = [];
		while($line = fgets($f)){
			$this->data[] = str_split(trim($line));
		}
		$this->dims['x'] = count($this->data);
		$this->dims['y'] = count($this->data[0]);
		foreach($this->data as $x=>$line){
			foreach($line as $y=>$letter){
				if($letter == 'X'){
					$this->findXMAS($x, $y);
				} elseif($letter == 'A'){
					if($this->isXMAS($x, $y)){
						$this->solution_2++;
					}
				}
			}
		}
	}
}