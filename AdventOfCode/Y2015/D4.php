<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D4 extends Day{
	private $str;
	public function __construct(){
		$this->str = file_get_contents(__DIR__.'/D4.txt');
	}
	
	public function run(){
		$this->solution_1 = $this->calc('00000');
		$this->solution_w = $this->calc('000000');
	}
	
	private function calc($match){
		$i = 0;
		while(true){
			$hash = md5($this->str . $i);
			if(substr($hash, 0, strlen($match)) === $match){
				return $i;
			}
			$i++;
		}
	}
}