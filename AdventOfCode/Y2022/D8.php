<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;
use Eupeodes\AdventOfCode\helpers;

class D8 extends Day{
	private $dataFile = __DIR__.'/D8.txt';
	private $rows = [];
	private $cols = [];
	private $visible = [];
	private $scenic = [];
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$i = 0;
		while($line = fgets($f)){
			$this->rows[] = str_split(trim($line));
			if($i == 0){
				foreach($this->rows[0] as $cell){
					$this->cols[] = [$cell];
					$this->visible[$i][] = true;
					$this->scenic[$i][] = null;
				}
			} else {
				foreach($this->rows[$i] as $n=>$cell){
					$this->cols[$n][] = $cell;
					$this->visible[$i][] = false;
					$this->scenic[$i][] = null;
				}
			}
			$i++;
		}
		for($i=0;$i<count($this->rows);$i++){
			$max = -9;
			for($j=0;$j<count($this->cols);$j++){
				if($this->rows[$i][$j] > $max){
					$this->visible[$i][$j] = true;
					$max = $this->rows[$i][$j];
				}
			}
			$max = -9;
			for($j=count($this->cols)-1;$j>=0;$j--){
				if($this->rows[$i][$j] > $max){
					$this->visible[$i][$j] = true;
					$max = $this->rows[$i][$j];
				}
			}
		}
		for($i=0;$i<count($this->cols);$i++){
			$max = -9;
			for($j=0;$j<count($this->rows);$j++){
				if($this->cols[$i][$j] > $max){
					$this->visible[$j][$i] = true;
					$max = $this->cols[$i][$j];
				}
			}
			$max = -9;
			for($j=count($this->rows)-1;$j>=0;$j--){
				if($this->cols[$i][$j] > $max){
					$this->visible[$j][$i] = true;
					$max = $this->cols[$i][$j];
				}
			}
		}
		foreach($this->visible as $row){
			foreach($row as $cell){
				if($cell){
					$this->solution_1++;
				}
			}
		}
		foreach($this->scenic as $i=>$row){
			foreach($row as $j=>$tree){
				$this->scenic[$i][$j] = $this->getScenic($i, $j);
			}
		}
		foreach($this->scenic as $row){
			foreach($row as $cell){
				if($cell > $this->solution_2){
					$this->solution_2 = $cell;
				}
			}
		}
	}

	private function getScenic($i, $j){
		$h = $this->rows[$i][$j];
		for($x=$i-1;$x>=0;$x--){
			if($this->rows[$x][$j] >= $h){
				break;
			}
		}
		if($x == -1){
			$l = $i;
		} else {
			$l = $i - $x;
		}
		
		for($x=$i+1;$x<count($this->cols);$x++){
			if($this->rows[$x][$j] >= $h){
				break;
			}
		}
		$r = $x - $i;
		if($x == count($this->cols)){
			$r--;
		}
		for($y=$j-1;$y>=0;$y--){
			if($this->cols[$y][$i] >= $h){
				break;
			}
		}
		if($y == -1){
			$t = $j;
		} else {
			$t = $j - $y;
		}
		for($y=$j+1;$y<count($this->rows);$y++){
			if($this->cols[$y][$i] >= $h){
				break;
			}
		}
		$b = $y - $j;
		if($y == count($this->rows)){
			$b--;
		}
		return $l * $r * $t * $b;
	}
}