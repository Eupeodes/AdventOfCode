<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D10 extends Day{
	private $register = [1,1];
	private $x = 1;
	private $part1 = [20,60,100,140,180,220];
	private $dataFile = __DIR__.'/D10.txt';
	private $screen = [];
	private $cycle = 0;
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			$parts = explode(' ', trim($line));
			if($parts[0] == 'noop'){
				$this->draw();
				$this->register[] = $this->x;
			} else {
				$this->draw();
				$this->register[] = $this->x;
				$this->draw();
				$this->x += $parts[1];
				$this->register[] = $this->x;
			}
		}
		foreach($this->part1 as $n){
			$this->solution_1 += $n * $this->register[$n];
		}
		$bits = array_chunk($this->screen, 40);
		foreach($bits as $bit){
			echo implode('', $bit). "\n";
		}
		$this->solution_2 = 'Check text above';
	}

	private function draw(){
		$this->screen[] = abs($this->cycle % 40 - $this->x) < 2 ? '#' : '.';
		$this->cycle++;
	}
}