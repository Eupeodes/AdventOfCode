<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;
use Eupeodes\AdventOfCode\helpers;

class D5 extends Day{
	private $dataFile = __DIR__.'/D5.txt';
	private $stacks = [];
	private $stacks2 = [];
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$initialized = false;
		$tmp = [];
		while($line = fgets($f)){
			if($initialized){
				list($j1, $n, $j2, $from, $j3, $to) = explode(' ', trim($line));
				$this->move($from, $to, $n);
				$this->moveStack($from, $to, $n);
			} else {
				if(trim($line) == ''){
					$initialized = true;
					for($i = count($tmp) -2; $i>=0;$i--){
						for($j = 0;$j<count($tmp[$i]);$j++){
							$crate = trim($tmp[$i][$j]);
							if(!empty($crate)){
								$this->stacks[$j+1][] = substr($crate,1,1);
								$this->stacks2[$j+1][] = substr($crate,1,1);
							}
						}
					}
				} else {
					$tmp[] = str_split($line, 4);
				}
			}
		}
		$this->solution_1 = '';
		foreach($this->stacks as $stack){
			$this->solution_1 .= $stack[count($stack)-1];
		}
		$this->solution_2 = '';
		foreach($this->stacks2 as $stack){
			$this->solution_2 .= $stack[count($stack)-1];
		}
	}
	
	private function move($from, $to, $n){
		for($i = 1;$i<=$n;$i++){
			$this->stacks[$to][] = array_pop($this->stacks[$from]);
		}
	}
	
	private function moveStack($from, $to, $n){
		$this->stacks2[$to] = array_merge(
			$this->stacks2[$to],
			array_slice(
				$this->stacks2[$from],
				count($this->stacks2[$from])-$n,
				$n
			)
		);
		$this->stacks2[$from] = array_slice(
			$this->stacks2[$from],
			0,
			count($this->stacks2[$from]) - $n
		);
	}
}