<?php

namespace Eupeodes\AdventOfCode\Y2024;

use Eupeodes\AdventOfCode\Day;

class D6 extends Day{
	private $dataFile = __DIR__.'/D6.txt';
	private $grid = [];
	private $pos = [];
	private $corners = [];
	private $isLoop = false;
	public function __construct(){
	}
	
	private function step($count){
		$nextpos = $this->pos;
		switch($this->pos[2]){
			case 0:
				$nextpos[0]--;
				break;
			case 90;
				$nextpos[1]++;
				break;
			case 180:
				$nextpos[0]++;
				break;
			case 270:
				$nextpos[1]--;
				break;
		}
		if(!array_key_exists($nextpos[0], $this->grid) || !array_key_exists($nextpos[1], $this->grid[$nextpos[0]])){
			return false;
		}
		$res = $this->grid[$nextpos[0]][$nextpos[1]];
		switch($res){
			case '#':
			case '%':
				$str = implode('|', $this->pos);
				if(in_array($str, $this->corners)){
					$this->isLoop = true;
					return true;
				}
				$this->corners[] = $str;
				$this->pos[2] = ($nextpos[2] == 270 ? 0 : $nextpos[2]+90);
				break;
			case '.':
				if($count){
					$this->solution_1++;
				}
				$this->grid[$nextpos[0]][$nextpos[1]] = '*';
			case '*':
				$this->pos = $nextpos;
		}
		return true;
	}
	
	public function run(){
		$this->solution_1 = 1;
		$this->solution_2 = 0;
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			$this->grid[] = str_split(trim($line));
			$pos = strpos($line, '^');
			if($pos){
				$this->pos = [count($this->grid)-1, $pos, 0];
				$this->grid[count($this->grid)-1][$pos] = '*';
			}
		}
		$this->stdGrid = $this->grid;
		$this->stdPos = $this->pos;
		
		while($this->step(true));
		
		$this->grid1 = $this->grid;
		
		for($y=0;$y<count($this->grid1);$y++){
			for($x=0;$x<count($this->grid1[$y]);$x++){
				if($this->grid1[$y][$x] == '*'){
					$this->grid = $this->stdGrid;
					$this->pos = $this->stdPos;
					$this->isLoop = false;
					$this->corners = [];
					$this->grid[$y][$x] = '%';
					$n = 0;
					$in = true;
					while($in && !$this->isLoop){
						$res = $this->step(false);
						if(!$res){
							$in = false;
						}
						$n++;
					}
					if($res){
						$this->solution_2++;
					}
				}
			}
		}
	}
}