<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D2 extends Day{
	private $dataFile = __DIR__.'/D2.txt';
	private $lines;
	
	private $mapping = [
		'opp' => [
			'A' => 1, //rock
			'B' => 2, //paper
			'C' => 3  //scissors
		],
		'you' => [
			'X' => 1, //rock
			'Y' => 2, //paper
			'Z' => 3  //scissors
		]
	];
	
	// $outcomes[you][opp]
	private $outcomes = [
		1 => [
			1 => 3,
			2 => 0,
			3 => 6
		], 
		2 => [
			1 => 6,
			2 => 3,
			3 => 0
		], 
		3 => [
			1 => 0,
			2 => 6,
			3 => 3
		]
	];
	
	private $target = [
		'1' => [
			'X' => 3,
			'Y' => 1,
			'Z' => 2
		],
		2 => [
			'X' => 1,
			'Y' => 2,
			'Z' => 3
		],
		3 => [
			'X' => 2,
			'Y' => 3,
			'Z' => 1
		]
	];
	
	public function __construct(){
		$this->lines = file($this->dataFile);
	}
	
	private function calcResult($you, $opponent){
		$sy = $this->mapping['you'][$you];
		$so = $this->mapping['opp'][$opponent];
		$outcome = $this->outcomes[$sy][$so];
		return $outcome + $sy;
	}
	
	private function calcResult2($you, $opponent){
		$so = $this->mapping['opp'][$opponent];
		$sy = $this->target[$so][$you];
		$outcome = $this->outcomes[$sy][$so];
		return $outcome + $sy;
	}
	
	public function run(){
		foreach($this->lines as $line){
			list($opponent, $you) = explode(' ', trim($line));
			$this->solution_1 += $this->calcResult($you, $opponent);
			$this->solution_2 += $this->calcResult2($you, $opponent);
		}
	}
}