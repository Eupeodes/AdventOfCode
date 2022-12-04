<?php

namespace Eupeodes\AdventOfCode\Y{year};

use Eupeodes\AdventOfCode\Day;

class D{day} extends Day{
	private $dataFile = __DIR__.'/D{day}.txt';
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			
		}
		$this->solution_1 = 'NA';
		$this->solution_2 = 'NA';
	}
}