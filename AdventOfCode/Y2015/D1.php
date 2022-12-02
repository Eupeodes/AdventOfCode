<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D1 extends Day{
	private $data;
	public function __construct(){
		$this->data = file_get_contents(__DIR__.'/D1.txt');
	}
	
	public function run(){
		$open = substr_count($this->data, '(');
		$close = substr_count($this->data, ')');
		$this->solution_1 = $open - $close;
		
		$f = 0;
		for($i = 0; $i < strlen($this->data); $i++){
			if ($this->data[$i] == '('){
				$f++;
			} elseif($this->data[$i] == ')'){
				$f--;
			}
			if($f == -1){
				$this->solution_2 = $i+1;
				break;
			}
		}
	}
}