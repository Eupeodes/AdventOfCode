<?php

namespace Eupeodes\AdventOfCode\Y2023;

use Eupeodes\AdventOfCode\Day;

class D3 extends Day{
	private $dataFile = __DIR__.'/D3.txt';
	private $symbols = [];
	private $numbers = [];
	
	public function __construct(){
	}
	
	private function isPartnr($l, $i, $n){
		for($y = $l-1; $y <= $l+1;$y++){
			if(array_key_exists($y, $this->symbols)){
				for($x = $i-1;$x<=$i+strlen($n);$x++){
					if(array_key_exists($x, $this->symbols[$y])){
						print_r([$n, $this->symbols[$y][$x], $l, $i]);
						return True;
					}
				}
			}
		}
		return False;
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$l = 0;
		while($line = trim(fgets($f))){
			$this->symbols[$l] = [];
			$this->numbers[$l] = [];
			$prev = '.';
			$start = 0;
			foreach(str_split($line) as $i=>$char){
				if($char == '.'){
					$prev = '.';
				} elseif (is_numeric($char)){
					if($prev == 'i'){
						$this->numbers[$l][$start] .= $char;
					} else {
						$this->numbers[$l][$i] = $char;
						$prev = 'i';
						$start = $i;
					}
				} else {
					$this->symbols[$l][$i] = $char;
					$prev = 'c';
				}
			}
			$l++;
		}
		$this->solution_1 = 0;
		foreach($this->numbers as $l=>$line){
			foreach($line as $i=>$n){
				if($this->isPartnr($l, $i, $n)){
					$this->solution_1 += $n;
				}
			}
		}
		$this->solution_2 = 0;
		foreach($this->symbols as $l=>$line){
			foreach($line as $i=>$n){
				if($n == '*'){
					var_dump([$l, $i]);
				}
			}
		}
	}
}