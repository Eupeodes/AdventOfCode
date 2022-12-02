<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D1 extends Day{
	private $dataFile = __DIR__.'/D1.txt';
	private $lines;
	private $res = [0];
	
	public function __construct(){
		$this->lines = file($this->dataFile);
	}
	
	public function run(){
		$i = 0;
		foreach($this->lines as $line){
			$val = intval($line);
			if($val > 0){
				$this->res[$i]+=$val;
			} else {
				$i++;
				$this->res[$i] = 0;
			}
		}
		rsort($this->res);
		$this->solution_1 = $this->res[0];
		$this->solution_2 = array_sum(array_slice($this->res, 0, 3));
	}
}