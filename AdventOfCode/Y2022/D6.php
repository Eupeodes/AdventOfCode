<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D6 extends Day{
	private $dataFile = __DIR__.'/D6.txt';
	private $data;
	public function __construct(){
	}
	
	public function run(){
		$this->data = trim(file_get_contents($this->dataFile));
		
		
		$this->solution_1 = $this->getMarkerEndPosition(4);
		$this->solution_2 = $this->getMarkerEndPosition(14);
	}

	private function getMarkerEndPosition($l){
		$data = str_split($this->data);
		$last = [];
		for($i = 0; $i < count($data);$i++){
			$last[] = $data[$i];
			if(count($last) == $l+1){
				array_shift($last);
			}
			if(count($last) == $l){
				if(count(array_unique($last)) == $l){
					return $i+1;
				}
			}
		}
	}
}
