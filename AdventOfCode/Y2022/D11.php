<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;
use Eupeodes\AdventOfCode\helpers;

class D11 extends Day{
	private $dataFile = __DIR__.'/D11.txt';

	private $monkeys = [];
	private $monkeys2 = [];

	public function __construct(){
		$data = file_get_contents($this->dataFile);
		$parts = explode("\n\n", $data);
		$lcm = null;
		foreach($parts as $part){
			$lines = explode("\n", $part);
			preg_match_all('/[0-9]{1,}/', implode('', array_slice($lines, 3)), $matches);
			$test = [
				'divide' => $matches[0][0],
				'true' => $matches[0][1],
				'false' => $matches[0][2],
			];

			$operation = array_slice(explode(' ', $lines[2]), -3);;
			$inventory = explode(', ', explode(': ', $lines[1])[1]);
			$this->monkeys[] = new Monkey(
				$inventory,
				$operation,
				$test,
				3
			);
			$this->monkeys2[] = new Monkey(
				$inventory,
				$operation,
				$test,
				1
			);
			$lcm = $lcm ? helpers::least_common_multiple($test['divide'], $lcm) : $test['divide'];
		}

		foreach($this->monkeys as $monkey){
			$monkey->setMonkeys($this->monkeys);
			$monkey->setLcm($lcm);
		}

		foreach($this->monkeys2 as $monkey){
			$monkey->setMonkeys($this->monkeys2);
			$monkey->setLcm($lcm);
		}
	}
	
	public function run(){
		for($i = 0;$i<20;$i++){
			foreach($this->monkeys as $monkey){
				$monkey->handleInventory();
			}
		}
		$inspects = [];
		foreach($this->monkeys as $monkey){
			$inspects[] = $monkey->inspects;
		}
		rsort($inspects);
		$this->solution_1 = $inspects[0] * $inspects[1];
		
		for($i = 0;$i<10000;$i++){
			foreach($this->monkeys2 as $monkey){
				$monkey->handleInventory();
			}
		}
		$inspects = [];
		foreach($this->monkeys2 as $monkey){
			$inspects[] = $monkey->inspects;
		}
		rsort($inspects);
		$this->solution_2 = $inspects[0] * $inspects[1];
	}
}

class Monkey{
	public $inventory = [];
	private $operation;
	public $test = [];
	private $monkeys;
	public $inspects = 0;
	private $relieve;
	private $lcm = 1;
	public function __construct($inventory, $operation, $test, $relieve){
		$this->inventory = $inventory;
		$this->operation = $operation;
		$this->test = $test;
		$this->relieve = $relieve;
	}
	public function setLcm($lcm){
		$this->lcm = $lcm;
	}
	public function setMonkeys($monkeys){
		$this->monkeys = $monkeys;
	}

	public function send($item){
		if($item % $this->test['divide'] == 0){
			$this->monkeys[$this->test['true']]->receive($item);
		} else {
			$this->monkeys[$this->test['false']]->receive($item);
		}
	}
	public function receive($item){
		$this->inventory[] = $item;
	}

	private function updateWorry($worry){
		$a = $worry;
		$b = $this->operation[2] == 'old' ? $worry : $this->operation[2];
		if($this->operation[1] == '*'){
			$worry = $a * $b;
		} else {
			$worry = $a + $b;
		}
		return floor($worry/$this->relieve) % $this->lcm;
	}

	public function handleInventory(){
		foreach($this->inventory as $item){
			$item = $this->updateWorry($item);
			$this->send($item);
			$this->inspects++;
		}
		$this->inventory = [];
	}
}