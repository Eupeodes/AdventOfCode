<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D6 extends Day{
	private $dataFile = __DIR__.'/D6.txt';
	private $grid = [];
	private $grid2 = [];
	
	public function __construct(){
		for($x=0; $x<1000; $x++){
			$this->grid[$x] = [];
			for($y=0; $y<1000; $y++){
				$this->grid[$x][$y] = false;
				$this->grid2[$x][$y] = 0;
			}
		}
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$chunk = [];
		while($line = fgets($f)){
			preg_match('/^(?<action>[a-z ]*) (?<x1>[0-9]*),(?<y1>[0-9]*) through (?<x2>[0-9]*),(?<y2>[0-9]*)$/', $line, $matches);
			$this->switchGrid(
				$matches['x1'],
				$matches['y1'],
				$matches['x2'],
				$matches['y2'],
				$matches['action']
			);
		}
		$this->solution_1 = $this->countOn();
		$this->solution_2 = $this->sumBrightness();
	}
	
	private function countOn(){
		$res = 0;
		foreach($this->grid as $row){
			foreach($row as $cell){
				if($cell){
					$res++;
				}
			}
		}
		return $res;
	}
	
	private function sumBrightness(){
		$res = 0;
		foreach($this->grid2 as $row){
			$res += array_sum($row);
		}
		return $res;
	}
	
	private function switch($x, $y, $action){
		switch($action){
			case 'turn on':
				$this->grid[$x][$y] = true;
				$this->grid2[$x][$y]++;
				break;
			case 'turn off':
				$this->grid[$x][$y] = false;
				if($this->grid2[$x][$y] > 0){
					$this->grid2[$x][$y]--;
				}
				break;
			case 'toggle':
				$this->grid[$x][$y] = !$this->grid[$x][$y];
				$this->grid2[$x][$y] += 2;
		}
	}
	
	private function switchGrid($x1, $y1, $x2, $y2, $action){
		for($x=$x1;$x<=$x2;$x++){
			for($y=$y1;$y<=$y2;$y++){
				$this->switch($x, $y, $action);
			}
		}
		
	}
}