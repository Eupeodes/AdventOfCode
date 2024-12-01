<?php

namespace Eupeodes\AdventOfCode\Y2023;

use Eupeodes\AdventOfCode\Day;

class D2 extends Day{
	private $dataFile = __DIR__.'/D2.txt';
	private $bag = [
		'red' => 12,
		'green' =>  13,
		'blue' => 14
	];
	
	public function __construct(){}
	
	private function isPossible($matches){
		if(max($matches['red']) > $this->bag['red']){
			return false;
		}
		if(max($matches['green']) > $this->bag['green']){
			return false;
		}
		if(max($matches['blue']) > $this->bag['blue']){
			return false;
		}
		return true;
	}
	
	private function pow($matches){
		return max($matches['red']) * max($matches['green']) * max($matches['blue']);
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$this->solution_1 = 0;
		$this->solution_2 = 0;
		while($line = fgets($f)){
			preg_match_all('/Game (?P<nr>[0-9]*)|((?P<green>[0-9]*) green)|((?P<blue>[0-9]*) blue)|((?P<red>[0-9]*) red)/', $line, $matches);
			$game = $matches['nr'][0];
			if ($this->isPossible($matches)){
				$this->solution_1 += $game;
			}
			$this->solution_2 += $this->pow($matches);
		}
	}
}