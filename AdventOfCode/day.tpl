<?php

namespace Eupeodes\AdventOfCode\Y{year};

use Eupeodes\AdventOfCode\Day;

class D{day} extends Day{
	private $dataFile = __DIR__.'/D{day}.txt';
	public function __construct(){
	}
	
	public function run(){
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			
		}
	}
}