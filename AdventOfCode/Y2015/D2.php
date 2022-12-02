<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D2 extends Day{
	private $lines;
	public function __construct(){
		$this->lines = file(__DIR__.'/D2.txt');
	}
	
	public function run(){
		$t = 0;
		$h = 0;
		foreach($this->lines as $line){
			list($x, $y, $z) = explode('x', trim($line));
			$a = $x*$y;
			$b = $x*$z;
			$c = $y*$z;
			$d = min([$a,$b,$c]);
			$s = 2 * ($a + $b + $c) + $d;
			$t += $s;

			$r = [$x, $y, $z];
			sort($r);
			$l = 2 * ($r[0] + $r[1]) + $x *$y * $z;
			$h += $l;
		}
		$this->solution_1 = $t;
		$this->solution_2 = $h;

	}
}