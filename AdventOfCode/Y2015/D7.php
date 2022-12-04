<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D7 extends Day{
	private $dataFile = __DIR__.'/D7.txt';
	private $data = [];
	
	public function __construct(){
	}
	
	public function run(){
		$this->fillData();
		$this->solution_1 = $this->getValue('a');
		$this->fillData();
		$this->data['b']['command'] = $this->solution_1;
		$this->solution_2 = $this->getValue('a');
	}
	
	private function fillData(){
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			list($source, $target) = explode(' -> ', trim($line));
			$this->data[$target] = [
				'command' => $source,
				'value' => null
			];
		}
	}
	
	private function getValue($target){
		if(is_numeric(($target))){
			return $target;
		}
		if(is_null($this->data[$target]['value'])){
			$this->calculateValue($target);
		}
		return $this->data[$target]['value'];
	}
	
	private function calculateValue($target){
		$parts = explode(' ', $this->data[$target]['command']);
		switch(count($parts)){
			case 1:
				$this->data[$target]['value'] = $this->getValue($parts[0]);
				break;
			case 2:
				$this->data[$target]['value'] = ~$this->getValue($parts[1]);
				break;
			default:
				switch($parts[1]){
					case 'AND':
						$this->data[$target]['value'] = $this->getValue($parts[0]) & $this->getValue($parts[2]);
						break;
					case 'OR':
						$this->data[$target]['value'] = $this->getValue($parts[0]) | $this->getValue($parts[2]);
						break;
					case 'LSHIFT':
						$this->data[$target]['value'] = $this->getValue($parts[0]) << $parts[2];
						break;
					case 'RSHIFT':
						
						$this->data[$target]['value'] = $this->getValue($parts[0]) >> $parts[2];
						break;
				}
		}
		//AND/OR
		//RSHIFT/LSHIFT
		//NOT
		//'simple'
	}
}