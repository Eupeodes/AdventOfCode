<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;
use Eupeodes\AdventOfCode\helpers;

class D8 extends Day{
	private $dataFile = __DIR__.'/D8.txt';
	public function __construct(){
	}
	
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$new = 0;
		$old = 0;
		while($line = fgets($f)){
			if(strlen(trim($line)) > 0){
				$return = $this->countChars($line);
				$this->solution_1 += $return['overhead'];
				$this->solution_2 += $return['expand'];
			}
		}
	}

	private function countChars($str){
		$str = trim($str);
		preg_match_all('/\\\\([\\\\"]|x[0-9a-f]{2})/', $str, $matches);
		$substract = 2;
		foreach($matches[0] as $match){
			$substract += strlen($match) - 1;
		}
		$expand = 2
			+ substr_count($str, '"')
			+ substr_count($str, '\\');
		return [
			'overhead' => $substract,
			'expand' => $expand
		];
	}
}