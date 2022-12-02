<?php

//rewrite for long file from tweakers.net

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D1l extends Day{
	private $dataFile = __DIR__.'/D1l.txt';
	public function run(){
		$f = fopen($this->dataFile, 'r');
		$res = [0,0,0];
		$e = 0;
		while($line = fgets($f)){
			$val = intval($line);
			if($val > 0){
				$e += $val;
			} else {
				$res[] = $e;
				$e = 0;
				rsort($res);
				$res = array_slice($res, 0, 3);
			}
		}
		$this->solution_1 = $res[0];
		$this->solution_2 = array_sum($res);
	}
}